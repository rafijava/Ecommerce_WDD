<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Services\EmsShippingService;
use App\Services\SmsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(Request $request, EmsShippingService $ems): View
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $variantIds = array_keys($cart);
        $variants = ProductVariant::with('product')->whereIn('id', $variantIds)->get()->keyBy('id');

        $items = [];
        $subtotal = 0;

        foreach ($cart as $variantId => $entry) {
            $variant = $variants[$variantId] ?? null;
            if (! $variant) {
                continue;
            }

            $product = $variant->product;
            $lineTotal = $product->price * $entry['quantity'];
            $subtotal += $lineTotal;

            $items[] = [
                'variant' => $variant,
                'product' => $product,
                'quantity' => $entry['quantity'],
                'line_total' => $lineTotal,
            ];
        }

        $division = old('shipping_division', 'Dhaka');
        $shippingCost = $ems->rateFor($division);
        $total = $subtotal + $shippingCost;

        $emsRates = array_combine(
            $ems->divisions(),
            array_map(fn ($d) => $ems->rateFor($d), $ems->divisions())
        );

        return view('checkout.index', [
            'items' => $items,
            'subtotal' => $subtotal,
            'shippingCost' => $shippingCost,
            'total' => $total,
            'divisions' => $ems->divisions(),
            'emsRates' => $emsRates,
        ]);
    }

    public function store(Request $request, EmsShippingService $ems, SmsService $sms): RedirectResponse
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:120',
            'customer_email' => 'required|email|max:120',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_division' => 'required|in:'.implode(',', $ems->divisions()),
            'payment_method' => 'required|in:cod,mobile_banking',
        ]);

        $variantIds = array_keys($cart);
        $variants = ProductVariant::with('product')->whereIn('id', $variantIds)->get()->keyBy('id');

        $items = [];
        $subtotal = 0;

        foreach ($cart as $variantId => $entry) {
            $variant = $variants[$variantId] ?? null;

            if (! $variant || $variant->stock < $entry['quantity']) {
                return redirect()->route('cart.index')->with('error', 'A selected item is no longer available in the requested quantity.');
            }

            $product = $variant->product;
            $lineTotal = $product->price * $entry['quantity'];
            $subtotal += $lineTotal;

            $items[] = [
                'variant' => $variant,
                'product' => $product,
                'quantity' => $entry['quantity'],
                'line_total' => $lineTotal,
            ];
        }

        $shippingCost = $ems->rateFor($validated['shipping_division']);
        $total = $subtotal + $shippingCost;

        $order = Order::create([
            'order_number' => 'ORD-'.now()->format('Ymd-His').'-'.rand(1000, 9999),
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'shipping_address' => $validated['shipping_address'],
            'shipping_division' => $validated['shipping_division'],
            'shipping_cost' => $shippingCost,
            'total_amount' => $total,
            'payment_method' => $validated['payment_method'],
            'payment_status' => $validated['payment_method'] === 'mobile_banking' ? 'paid' : 'pending',
            'status' => 'pending',
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'variant_id' => $item['variant']->id,
                'size' => $item['variant']->size,
                'quantity' => $item['quantity'],
                'price' => $item['product']->price,
            ]);

            $item['variant']->decrement('stock', $item['quantity']);
        }

        Mail::to($order->customer_email)->send(new OrderPlaced($order));

        $smsMessage = sprintf(
            'Hi %s, your UrbanFit order %s has been received. Total: BDT %s. Thank you.',
            $order->customer_name,
            $order->order_number,
            number_format($order->total_amount, 2)
        );

        $sms->send($order->customer_phone, $order->id, $order->total_amount, $smsMessage);

        Session::forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully.');
    }
}
