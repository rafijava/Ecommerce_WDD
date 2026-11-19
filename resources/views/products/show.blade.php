<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6 sm:flex gap-8">
                <div class="sm:w-1/2">
                    <img src="{{ $product->image ?? 'https://placehold.co/600x400?text=No+Image' }}" alt="{{ $product->name }}" class="w-full rounded-lg">
                </div>
                <div class="sm:w-1/2 mt-6 sm:mt-0">
                    <p class="text-indigo-600 font-semibold uppercase text-sm">{{ $product->category->name }}</p>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                    <p class="text-xl text-gray-700 mt-2">BDT {{ number_format($product->price, 2) }}</p>
                    <p class="text-gray-600 mt-4">{{ $product->description }}</p>

                    @if (! $product->inStock())
                        <div class="mt-6 p-4 bg-red-50 text-red-800 rounded-lg border border-red-200">
                            Item is out of stock.
                        </div>
                    @else
                        <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form" class="mt-6">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="variant_id" id="variant_id" value="">

                            <label class="block text-sm font-medium text-gray-700">Select Size</label>
                            <div class="grid grid-cols-4 gap-2 mt-2" id="size-selector">
                                @foreach ($product->variants as $variant)
                                    <button type="button"
                                            data-variant-id="{{ $variant->id }}"
                                            data-stock="{{ $variant->stock }}"
                                            data-size="{{ $variant->size }}"
                                            class="size-btn px-3 py-2 border rounded text-center text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-red-100 disabled:text-red-700"
                                            {{ $variant->stock <= 0 ? 'disabled' : '' }}>
                                        {{ $variant->size }}
                                        @if ($variant->stock <= 0)<br><span class="text-xs">Out</span>@endif
                                    </button>
                                @endforeach
                            </div>
                            @error('variant_id')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror

                            <label for="quantity" class="block text-sm font-medium text-gray-700 mt-4">Quantity</label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="10" class="mt-1 w-24 rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('quantity')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror

                            <p id="stock-message" class="text-sm text-red-600 mt-2 min-h-[1.5rem]"></p>

                            <button type="submit" id="add-btn" class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                                Add to Cart
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($product->inStock())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const form = document.getElementById('add-to-cart-form');
                const variantInput = document.getElementById('variant_id');
                const addBtn = document.getElementById('add-btn');
                const stockMessage = document.getElementById('stock-message');
                const buttons = document.querySelectorAll('.size-btn');

                buttons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        if (btn.disabled) return;

                        buttons.forEach(b => b.classList.remove('bg-indigo-600', 'text-white', 'border-indigo-600'));
                        btn.classList.add('bg-indigo-600', 'text-white', 'border-indigo-600');

                        variantInput.value = btn.dataset.variantId;
                        stockMessage.textContent = `In stock: ${btn.dataset.stock}`;
                        addBtn.disabled = false;
                    });
                });

                form.addEventListener('submit', (e) => {
                    if (! variantInput.value) {
                        e.preventDefault();
                        stockMessage.textContent = 'Please select a size first.';
                    }
                });
            });
        </script>
    @endif
</x-app-layout>
