<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow overflow-x-auto p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="pb-2">Order #</th>
                            <th class="pb-2">Customer</th>
                            <th class="pb-2">Phone</th>
                            <th class="pb-2">Payment</th>
                            <th class="pb-2">Update</th>
                            <th class="pb-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-b align-top">
                                <td class="py-3">{{ $order->order_number }}</td>
                                <td class="py-3">{{ $order->customer_name }}<br><span class="text-sm text-gray-500">{{ $order->customer_email }}</span></td>
                                <td class="py-3">{{ $order->customer_phone }}</td>
                                <td class="py-3">{{ strtoupper($order->payment_method) }}</td>
                                <td class="py-3">
                                    <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="flex gap-2 items-center">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="rounded border-gray-300 text-sm">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <select name="payment_status" class="rounded border-gray-300 text-sm">
                                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                                            <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                        </select>
                                        <button type="submit" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">Save</button>
                                    </form>
                                </td>
                                <td class="py-3 text-right">BDT {{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="pb-4 text-sm text-gray-600">
                                    @foreach ($order->items as $item)
                                        <div>{{ $item->product->name }} ({{ $item->size }}) × {{ $item->quantity }}</div>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
