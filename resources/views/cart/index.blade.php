<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                @if (count($items) === 0)
                    <p class="text-gray-600">Your cart is empty.</p>
                    <a href="{{ route('products.index') }}" class="mt-4 inline-block text-indigo-600 hover:underline">Continue shopping</a>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="pb-3 border-b">Product</th>
                                <th class="pb-3 border-b">Size</th>
                                <th class="pb-3 border-b">Price</th>
                                <th class="pb-3 border-b">Qty</th>
                                <th class="pb-3 border-b">Total</th>
                                <th class="pb-3 border-b"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="border-b">
                                    <td class="py-4">
                                        <div class="font-medium text-gray-900">{{ $item['product']->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $item['product']->sku }}</div>
                                    </td>
                                    <td class="py-4">{{ $item['variant']->size }}</td>
                                    <td class="py-4">BDT {{ number_format($item['product']->price, 2) }}</td>
                                    <td class="py-4">
                                        <form action="{{ route('cart.update', $item['variant']->id) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="0" max="10" class="w-20 rounded border-gray-300 shadow-sm">
                                            <button type="submit" class="text-sm text-indigo-600 hover:underline">Update</button>
                                        </form>
                                    </td>
                                    <td class="py-4">BDT {{ number_format($item['line_total'], 2) }}</td>
                                    <td class="py-4">
                                        <form action="{{ route('cart.remove', $item['variant']->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6 flex justify-between items-center">
                        <div class="text-xl font-semibold text-gray-900">
                            Subtotal: BDT {{ number_format($subtotal, 2) }}
                        </div>
                        <a href="{{ route('checkout.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                            Proceed to Checkout
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
