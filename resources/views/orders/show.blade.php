<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Confirmation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-green-600 text-5xl mb-4">✓</div>
                <h2 class="text-2xl font-bold text-gray-900">Thank you, {{ $order->customer_name }}</h2>
                <p class="text-gray-600 mt-2">Your order has been placed successfully.</p>
                <p class="text-xl font-semibold text-indigo-600 mt-2">{{ $order->order_number }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Details</h3>
                <div class="space-y-2 text-sm text-gray-700">
                    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                    <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Shipping Address:</strong><br>{{ nl2br(e($order->shipping_address)) }}</p>
                    <p><strong>Division:</strong> {{ $order->shipping_division }}</p>
                    <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                    <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                    <p><strong>Order Status:</strong> {{ ucfirst($order->status) }}</p>
                </div>

                <table class="w-full mt-6 text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2">Product</th>
                            <th class="pb-2">Size</th>
                            <th class="pb-2">Qty</th>
                            <th class="pb-2 text-right">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr class="border-b">
                                <td class="py-2">{{ $item->product->name }}</td>
                                <td class="py-2">{{ $item->size }}</td>
                                <td class="py-2">{{ $item->quantity }}</td>
                                <td class="py-2 text-right">BDT {{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4 space-y-1 text-right">
                    <p>Subtotal: BDT {{ number_format($order->total_amount - $order->shipping_cost, 2) }}</p>
                    <p>Shipping (EMS): BDT {{ number_format($order->shipping_cost, 2) }}</p>
                    <p class="text-xl font-bold text-gray-900">Total: BDT {{ number_format($order->total_amount, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
