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
            <?php echo e(__('Checkout')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Shipping & Payment</h3>
                    <form action="<?php echo e(route('checkout.store')); ?>" method="POST" id="checkout-form">
                        <?php echo csrf_field(); ?>

                        <div class="mb-4">
                            <label for="customer_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="customer_name" id="customer_name" value="<?php echo e(old('customer_name')); ?>" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-4">
                            <label for="customer_email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="customer_email" id="customer_email" value="<?php echo e(old('customer_email')); ?>" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <?php $__errorArgs = ['customer_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-4">
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="tel" name="customer_phone" id="customer_phone" value="<?php echo e(old('customer_phone')); ?>" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <?php $__errorArgs = ['customer_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-4">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700">Address</label>
                            <textarea name="shipping_address" id="shipping_address" rows="3" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required><?php echo e(old('shipping_address')); ?></textarea>
                            <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-4">
                            <label for="shipping_division" class="block text-sm font-medium text-gray-700">Shipping Division (EMS)</label>
                            <select name="shipping_division" id="shipping_division" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($division); ?>" <?php echo e(old('shipping_division', 'Dhaka') === $division ? 'selected' : ''); ?>><?php echo e($division); ?> — BDT <?php echo e(number_format($emsRates[$division], 2)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['shipping_division'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                            <div class="mt-2 space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="cod" <?php echo e(old('payment_method') === 'cod' ? 'checked' : ''); ?> class="text-indigo-600 focus:ring-indigo-500" required>
                                    <span class="ml-2">Cash on Delivery (COD)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="mobile_banking" <?php echo e(old('payment_method') === 'mobile_banking' ? 'checked' : ''); ?> class="text-indigo-600 focus:ring-indigo-500" required>
                                    <span class="ml-2">Mobile Banking (Sandbox)</span>
                                </label>
                            </div>
                            <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 font-semibold">
                            Place Order
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h3>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex justify-between text-sm">
                                <span><?php echo e($item['product']->name); ?> (<?php echo e($item['variant']->size); ?>) × <?php echo e($item['quantity']); ?></span>
                                <span>BDT <?php echo e(number_format($item['line_total'], 2)); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="mt-6 pt-4 border-t space-y-2">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span id="summary-subtotal">BDT <?php echo e(number_format($subtotal, 2)); ?></span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>EMS Shipping</span>
                            <span id="summary-shipping">BDT <?php echo e(number_format($shippingCost, 2)); ?></span>
                        </div>
                        <div class="flex justify-between text-xl font-bold text-gray-900 pt-2 border-t">
                            <span>Total</span>
                            <span id="summary-total">BDT <?php echo e(number_format($total, 2)); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const rates = <?php echo json_encode($emsRates, 15, 512) ?>;
        const subtotal = <?php echo e($subtotal); ?>;

        const divisionSelect = document.getElementById('shipping_division');
        const shippingEl = document.getElementById('summary-shipping');
        const totalEl = document.getElementById('summary-total');

        function updateShipping() {
            const rate = rates[divisionSelect.value] || 150;
            shippingEl.textContent = 'BDT ' + rate.toFixed(2);
            totalEl.textContent = 'BDT ' + (subtotal + rate).toFixed(2);
        }

        divisionSelect.addEventListener('change', updateShipping);
        updateShipping();
    </script>
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
<?php /**PATH /var/www/job3/resources/views/checkout/index.blade.php ENDPATH**/ ?>