<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop UrbanFit BD') }}
        </h2>
    </x-slot>

    <div class="relative bg-gray-900 overflow-hidden">
        <img src="https://placehold.co/1600x500/111827/ffffff?text=UrbanFit+BD+-+Modern+Streetwear" alt="UrbanFit BD banner" class="w-full h-64 sm:h-80 object-cover opacity-60">
        <div class="absolute inset-0 flex items-center justify-center text-center px-4">
            <div>
                <h1 class="text-3xl sm:text-5xl font-bold text-white drop-shadow-lg">UrbanFit BD</h1>
                <p class="mt-2 text-lg text-gray-200">Men's, Women's & Accessories — Made for the City</p>
                <a href="#shop" class="mt-6 inline-block bg-indigo-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-indigo-700 transition">Shop Now</a>
            </div>
        </div>
    </div>

    <div id="shop" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-4 mb-6 overflow-x-auto">
                <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-full text-sm {{ request('category') ? 'bg-gray-200 text-gray-700' : 'bg-indigo-600 text-white' }}">All</a>
                <a href="{{ route('products.index', ['category' => 'men']) }}" class="px-4 py-2 rounded-full text-sm {{ request('category') === 'men' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }}">Men</a>
                <a href="{{ route('products.index', ['category' => 'women']) }}" class="px-4 py-2 rounded-full text-sm {{ request('category') === 'women' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }}">Women</a>
                <a href="{{ route('products.index', ['category' => 'accessories']) }}" class="px-4 py-2 rounded-full text-sm {{ request('category') === 'accessories' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }}">Accessories</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <a href="{{ route('products.show', $product->slug) }}" class="group block bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden border border-gray-100">
                        <div class="overflow-hidden">
                            <img src="{{ $product->image ?? 'https://placehold.co/600x400?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover transform group-hover:scale-105 transition duration-300">
                        </div>
                        <div class="p-4">
                            <p class="text-xs text-indigo-600 uppercase font-semibold">{{ $product->category->name }}</p>
                            <h3 class="text-lg font-semibold text-gray-900 mt-1">{{ $product->name }}</h3>
                            <p class="text-gray-600 mt-2 font-medium">BDT {{ number_format($product->price, 2) }}</p>
                            @if (! $product->inStock())
                                <span class="inline-block mt-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Out of Stock</span>
                            @else
                                <span class="inline-block mt-2 px-2 py-1 text-xs bg-green-100 text-green-800 rounded">In Stock</span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
