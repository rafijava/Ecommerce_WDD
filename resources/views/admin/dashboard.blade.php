<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-sm text-gray-500">Pending Orders</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $pendingOrders }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-sm text-gray-500">Products</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <div class="flex gap-4">
                    <a href="{{ route('admin.orders') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Manage Orders</a>
                    <a href="{{ route('admin.products') }}" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900">Manage Stock</a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Orders</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2">Order #</th>
                            <th class="pb-2">Customer</th>
                            <th class="pb-2">Payment</th>
                            <th class="pb-2">Status</th>
                            <th class="pb-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-b">
                                <td class="py-2">{{ $order->order_number }}</td>
                                <td class="py-2">{{ $order->customer_name }}</td>
                                <td class="py-2">{{ strtoupper($order->payment_method) }} ({{ ucfirst($order->payment_status) }})</td>
                                <td class="py-2">{{ ucfirst($order->status) }}</td>
                                <td class="py-2 text-right">BDT {{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
