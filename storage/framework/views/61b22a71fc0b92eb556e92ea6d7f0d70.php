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
            <?php echo e(__('Admin Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-900"><?php echo e($totalOrders); ?></p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-sm text-gray-500">Pending Orders</p>
                    <p class="text-2xl font-bold text-gray-900"><?php echo e($pendingOrders); ?></p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-sm text-gray-500">Products</p>
                    <p class="text-2xl font-bold text-gray-900"><?php echo e($totalProducts); ?></p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <div class="flex gap-4">
                    <a href="<?php echo e(route('admin.orders')); ?>" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Manage Orders</a>
                    <a href="<?php echo e(route('admin.products')); ?>" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900">Manage Stock</a>
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
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b">
                                <td class="py-2"><?php echo e($order->order_number); ?></td>
                                <td class="py-2"><?php echo e($order->customer_name); ?></td>
                                <td class="py-2"><?php echo e(strtoupper($order->payment_method)); ?> (<?php echo e(ucfirst($order->payment_status)); ?>)</td>
                                <td class="py-2"><?php echo e(ucfirst($order->status)); ?></td>
                                <td class="py-2 text-right">BDT <?php echo e(number_format($order->total_amount, 2)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
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
<?php /**PATH /var/www/job3/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>