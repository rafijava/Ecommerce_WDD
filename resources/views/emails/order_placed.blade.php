<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
</head>
<body>
    <h2>Thank you for your order, {{ $order->customer_name }}</h2>
    <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
    <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
    <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
    <p><strong>Order Status:</strong> {{ ucfirst($order->status) }}</p>

    <h3>Items</h3>
    <ul>
        @foreach ($order->items as $item)
            <li>{{ $item->product->name }} (Size: {{ $item->size }}) x{{ $item->quantity }} — ৳{{ number_format($item->price * $item->quantity, 2) }}</li>
        @endforeach
    </ul>

    <p><strong>Subtotal:</strong> ৳{{ number_format($order->total_amount - $order->shipping_cost, 2) }}</p>
    <p><strong>Shipping (EMS):</strong> ৳{{ number_format($order->shipping_cost, 2) }}</p>
    <p><strong>Total:</strong> ৳{{ number_format($order->total_amount, 2) }}</p>

    <p>Shipping to:<br>{{ nl2br(e($order->shipping_address)) }}</p>
</body>
</html>
