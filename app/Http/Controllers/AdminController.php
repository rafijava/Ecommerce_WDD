<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return view('admin.dashboard', [
            'orders' => Order::with('items')->latest()->limit(5)->get(),
            'totalOrders' => Order::count(),
            'totalProducts' => Product::count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
        ]);
    }

    public function orders(): View
    {
        return view('admin.orders', [
            'orders' => Order::with('items.product')->latest()->paginate(20),
        ]);
    }

    public function updateOrder(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
        ]);

        $order->update($validated);

        return back()->with('success', 'Order updated.');
    }

    public function products(Request $request): View
    {
        $products = Product::with(['category', 'variants'])
            ->when($request->query('search'), function ($query, $search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('sku', 'like', '%'.$search.'%');
            })
            ->latest()
            ->paginate(20);

        return view('admin.products', compact('products'));
    }

    public function updateStock(Request $request, ProductVariant $variant): RedirectResponse
    {
        $data = $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $variant->update($data);

        return back()->with('success', 'Stock updated for '.$variant->size.'.');
    }
}
