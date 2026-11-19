<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
</head>
<body>
    <h2>Thank you for your order, <?php echo e($order->customer_name); ?></h2>
    <p><strong>Order Number:</strong> <?php echo e($order->order_number); ?></p>
    <p><strong>Payment Method:</strong> <?php echo e(strtoupper($order->payment_method)); ?></p>
    <p><strong>Payment Status:</strong> <?php echo e(ucfirst($order->payment_status)); ?></p>
    <p><strong>Order Status:</strong> <?php echo e(ucfirst($order->status)); ?></p>

    <h3>Items</h3>
    <ul>
        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($item->product->name); ?> (Size: <?php echo e($item->size); ?>) x<?php echo e($item->quantity); ?> — ৳<?php echo e(number_format($item->price * $item->quantity, 2)); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <p><strong>Subtotal:</strong> ৳<?php echo e(number_format($order->total_amount - $order->shipping_cost, 2)); ?></p>
    <p><strong>Shipping (EMS):</strong> ৳<?php echo e(number_format($order->shipping_cost, 2)); ?></p>
    <p><strong>Total:</strong> ৳<?php echo e(number_format($order->total_amount, 2)); ?></p>

    <p>Shipping to:<br><?php echo e(nl2br(e($order->shipping_address))); ?></p>
</body>
</html>
<?php /**PATH /var/www/job3/resources/views/emails/order_placed.blade.php ENDPATH**/ ?>