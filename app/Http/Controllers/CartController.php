<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = Session::get('cart', []);
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

        return view('cart.index', compact('items', 'subtotal'));
    }

    public function add(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $product = Product::findOrFail($data['product_id']);
        $variant = ProductVariant::where('id', $data['variant_id'])
            ->where('product_id', $product->id)
            ->firstOrFail();

        if ($variant->stock <= 0) {
            return back()->withErrors(['variant_id' => 'Item is out of stock.']);
        }

        if ($variant->stock < $data['quantity']) {
            return back()->withErrors(['quantity' => 'Only '.$variant->stock.' item(s) available in this size.']);
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$variant->id])) {
            $newQuantity = $cart[$variant->id]['quantity'] + $data['quantity'];

            if ($newQuantity > $variant->stock) {
                return back()->withErrors(['quantity' => 'Requested quantity exceeds available stock.']);
            }

            $cart[$variant->id]['quantity'] = $newQuantity;
        } else {
            $cart[$variant->id] = [
                'product_id' => $product->id,
                'variant_id' => $variant->id,
                'size' => $variant->size,
                'quantity' => $data['quantity'],
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    public function update(Request $request, int $variantId): RedirectResponse
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:0|max:10',
        ]);

        $cart = Session::get('cart', []);

        if (! isset($cart[$variantId])) {
            return redirect()->route('cart.index');
        }

        $variant = ProductVariant::findOrFail($variantId);

        if ($data['quantity'] == 0) {
            unset($cart[$variantId]);
        } elseif ($data['quantity'] > $variant->stock) {
            return back()->withErrors(['quantity' => 'Only '.$variant->stock.' item(s) available.']);
        } else {
            $cart[$variantId]['quantity'] = $data['quantity'];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function remove(int $variantId): RedirectResponse
    {
        $cart = Session::get('cart', []);
        unset($cart[$variantId]);
        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item removed.');
    }
}
