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
            <?php echo e($product->name); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6 sm:flex gap-8">
                <div class="sm:w-1/2">
                    <img src="<?php echo e($product->image ?? 'https://placehold.co/600x400?text=No+Image'); ?>" alt="<?php echo e($product->name); ?>" class="w-full rounded-lg">
                </div>
                <div class="sm:w-1/2 mt-6 sm:mt-0">
                    <p class="text-indigo-600 font-semibold uppercase text-sm"><?php echo e($product->category->name); ?></p>
                    <h1 class="text-2xl font-bold text-gray-900"><?php echo e($product->name); ?></h1>
                    <p class="text-xl text-gray-700 mt-2">BDT <?php echo e(number_format($product->price, 2)); ?></p>
                    <p class="text-gray-600 mt-4"><?php echo e($product->description); ?></p>

                    <?php if(! $product->inStock()): ?>
                        <div class="mt-6 p-4 bg-red-50 text-red-800 rounded-lg border border-red-200">
                            Item is out of stock.
                        </div>
                    <?php else: ?>
                        <form action="<?php echo e(route('cart.add')); ?>" method="POST" id="add-to-cart-form" class="mt-6">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                            <input type="hidden" name="variant_id" id="variant_id" value="">

                            <label class="block text-sm font-medium text-gray-700">Select Size</label>
                            <div class="grid grid-cols-4 gap-2 mt-2" id="size-selector">
                                <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button"
                                            data-variant-id="<?php echo e($variant->id); ?>"
                                            data-stock="<?php echo e($variant->stock); ?>"
                                            data-size="<?php echo e($variant->size); ?>"
                                            class="size-btn px-3 py-2 border rounded text-center text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-red-100 disabled:text-red-700"
                                            <?php echo e($variant->stock <= 0 ? 'disabled' : ''); ?>>
                                        <?php echo e($variant->size); ?>

                                        <?php if($variant->stock <= 0): ?><br><span class="text-xs">Out</span><?php endif; ?>
                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php $__errorArgs = ['variant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-600 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <label for="quantity" class="block text-sm font-medium text-gray-700 mt-4">Quantity</label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="10" class="mt-1 w-24 rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-600 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <p id="stock-message" class="text-sm text-red-600 mt-2 min-h-[1.5rem]"></p>

                            <button type="submit" id="add-btn" class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                                Add to Cart
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if($product->inStock()): ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const form = document.getElementById('add-to-cart-form');
                const variantInput = document.getElementById('variant_id');
                const addBtn = document.getElementById('add-btn');
                const stockMessage = document.getElementById('stock-message');
                const buttons = document.querySelectorAll('.size-btn');

                buttons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        if (btn.disabled) return;

                        buttons.forEach(b => b.classList.remove('bg-indigo-600', 'text-white', 'border-indigo-600'));
                        btn.classList.add('bg-indigo-600', 'text-white', 'border-indigo-600');

                        variantInput.value = btn.dataset.variantId;
                        stockMessage.textContent = `In stock: ${btn.dataset.stock}`;
                        addBtn.disabled = false;
                    });
                });

                form.addEventListener('submit', (e) => {
                    if (! variantInput.value) {
                        e.preventDefault();
                        stockMessage.textContent = 'Please select a size first.';
                    }
                });
            });
        </script>
    <?php endif; ?>
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
<?php /**PATH /var/www/job3/resources/views/products/show.blade.php ENDPATH**/ ?>