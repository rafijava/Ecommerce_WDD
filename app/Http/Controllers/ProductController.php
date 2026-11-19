<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::with(['category', 'variants'])
            ->when($request->query('category'), function ($query, $category) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $category));
            })
            ->latest()
            ->paginate(12);

        return view('products.index', compact('products'));
    }

    public function show(string $slug): View
    {
        $product = Product::with(['category', 'variants'])->where('slug', $slug)->firstOrFail();

        return view('products.show', compact('product'));
    }
}
