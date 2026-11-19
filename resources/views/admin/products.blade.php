<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Stock') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <form method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="rounded border-gray-300 shadow-sm w-full max-w-md">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900">Search</button>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow overflow-x-auto p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2">Product</th>
                            <th class="pb-2">SKU</th>
                            <th class="pb-2">Category</th>
                            <th class="pb-2">Price</th>
                            <th class="pb-2">Variants</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="border-b align-top">
                                <td class="py-3">{{ $product->name }}</td>
                                <td class="py-3">{{ $product->sku }}</td>
                                <td class="py-3">{{ $product->category->name }}</td>
                                <td class="py-3">BDT {{ number_format($product->price, 2) }}</td>
                                <td class="py-3">
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                        @foreach ($product->variants as $variant)
                                            <form action="{{ route('admin.products.stock', $variant) }}" method="POST" class="flex items-center gap-1 text-sm">
                                                @csrf
                                                @method('PATCH')
                                                <label class="w-8">{{ $variant->size }}</label>
                                                <input type="number" name="stock" value="{{ $variant->stock }}" min="0" class="w-16 rounded border-gray-300 text-sm">
                                                <button type="submit" class="text-indigo-600 hover:underline text-xs">Save</button>
                                            </form>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
