<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Order Confirmation')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-green-600 text-5xl mb-4">✓</div>
                <h2 class="text-2xl font-bold text-gray-900">Thank you, <?php echo e($order->customer_name); ?></h2>
                <p class="text-gray-600 mt-2">Your order has been placed successfully.</p>
                <p class="text-xl font-semibold text-indigo-600 mt-2"><?php echo e($order->order_number); ?></p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Details</h3>
                <div class="space-y-2 text-sm text-gray-700">
                    <p><strong>Email:</strong> <?php echo e($order->customer_email); ?></p>
                    <p><strong>Phone:</strong> <?php echo e($order->customer_phone); ?></p>
                    <p><strong>Shipping Address:</strong><br><?php echo e(nl2br(e($order->shipping_address))); ?></p>
                    <p><strong>Division:</strong> <?php echo e($order->shipping_division); ?></p>
                    <p><strong>Payment Method:</strong> <?php echo e(strtoupper($order->payment_method)); ?></p>
                    <p><strong>Payment Status:</strong> <?php echo e(ucfirst($order->payment_status)); ?></p>
                    <p><strong>Order Status:</strong> <?php echo e(ucfirst($order->status)); ?></p>
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
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b">
                                <td class="py-2"><?php echo e($item->product->name); ?></td>
                                <td class="py-2"><?php echo e($item->size); ?></td>
                                <td class="py-2"><?php echo e($item->quantity); ?></td>
                                <td class="py-2 text-right">BDT <?php echo e(number_format($item->price * $item->quantity, 2)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <div class="mt-4 space-y-1 text-right">
                    <p>Subtotal: BDT <?php echo e(number_format($order->total_amount - $order->shipping_cost, 2)); ?></p>
                    <p>Shipping (EMS): BDT <?php echo e(number_format($order->shipping_cost, 2)); ?></p>
                    <p class="text-xl font-bold text-gray-900">Total: BDT <?php echo e(number_format($order->total_amount, 2)); ?></p>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /var/www/job3/resources/views/orders/show.blade.php ENDPATH**/ ?>