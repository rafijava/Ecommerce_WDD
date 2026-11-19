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
            <?php echo e(__('Shopping Cart')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <?php if(count($items) === 0): ?>
                    <p class="text-gray-600">Your cart is empty.</p>
                    <a href="<?php echo e(route('products.index')); ?>" class="mt-4 inline-block text-indigo-600 hover:underline">Continue shopping</a>
                <?php else: ?>
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
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-b">
                                    <td class="py-4">
                                        <div class="font-medium text-gray-900"><?php echo e($item['product']->name); ?></div>
                                        <div class="text-sm text-gray-500"><?php echo e($item['product']->sku); ?></div>
                                    </td>
                                    <td class="py-4"><?php echo e($item['variant']->size); ?></td>
                                    <td class="py-4">BDT <?php echo e(number_format($item['product']->price, 2)); ?></td>
                                    <td class="py-4">
                                        <form action="<?php echo e(route('cart.update', $item['variant']->id)); ?>" method="POST" class="flex items-center gap-2">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <input type="number" name="quantity" value="<?php echo e($item['quantity']); ?>" min="0" max="10" class="w-20 rounded border-gray-300 shadow-sm">
                                            <button type="submit" class="text-sm text-indigo-600 hover:underline">Update</button>
                                        </form>
                                    </td>
                                    <td class="py-4">BDT <?php echo e(number_format($item['line_total'], 2)); ?></td>
                                    <td class="py-4">
                                        <form action="<?php echo e(route('cart.remove', $item['variant']->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-600 hover:underline text-sm">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <div class="mt-6 flex justify-between items-center">
                        <div class="text-xl font-semibold text-gray-900">
                            Subtotal: BDT <?php echo e(number_format($subtotal, 2)); ?>

                        </div>
                        <a href="<?php echo e(route('checkout.index')); ?>" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                            Proceed to Checkout
                        </a>
                    </div>
                <?php endif; ?>
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
<?php /**PATH /var/www/job3/resources/views/cart/index.blade.php ENDPATH**/ ?>