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
            <?php echo e(__('Shop UrbanFit BD')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="relative bg-gray-900 overflow-hidden">
        <img src="https://placehold.co/1600x500/111827/ffffff?text=UrbanFit+BD+-+Modern+Streetwear" alt="UrbanFit BD banner" class="w-full h-64 sm:h-80 object-cover opacity-60">
        <div class="absolute inset-0 flex items-center justify-center text-center px-4">
            <div>
                <h1 class="text-3xl sm:text-5xl font-bold text-white drop-shadow-lg">UrbanFit BD</h1>
                <p class="mt-2 text-lg text-gray-200">Men's, Women's & Accessories — Made for the City</p>
                <a href="#shop" class="mt-6 inline-block bg-indigo-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-indigo-700 transition">Shop Now</a>
            </div>
        </div>
    </div>

    <div id="shop" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-4 mb-6 overflow-x-auto">
                <a href="<?php echo e(route('products.index')); ?>" class="px-4 py-2 rounded-full text-sm <?php echo e(request('category') ? 'bg-gray-200 text-gray-700' : 'bg-indigo-600 text-white'); ?>">All</a>
                <a href="<?php echo e(route('products.index', ['category' => 'men'])); ?>" class="px-4 py-2 rounded-full text-sm <?php echo e(request('category') === 'men' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'); ?>">Men</a>
                <a href="<?php echo e(route('products.index', ['category' => 'women'])); ?>" class="px-4 py-2 rounded-full text-sm <?php echo e(request('category') === 'women' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'); ?>">Women</a>
                <a href="<?php echo e(route('products.index', ['category' => 'accessories'])); ?>" class="px-4 py-2 rounded-full text-sm <?php echo e(request('category') === 'accessories' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'); ?>">Accessories</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="group block bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden border border-gray-100">
                        <div class="overflow-hidden">
                            <img src="<?php echo e($product->image ?? 'https://placehold.co/600x400?text=No+Image'); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-48 object-cover transform group-hover:scale-105 transition duration-300">
                        </div>
                        <div class="p-4">
                            <p class="text-xs text-indigo-600 uppercase font-semibold"><?php echo e($product->category->name); ?></p>
                            <h3 class="text-lg font-semibold text-gray-900 mt-1"><?php echo e($product->name); ?></h3>
                            <p class="text-gray-600 mt-2 font-medium">BDT <?php echo e(number_format($product->price, 2)); ?></p>
                            <?php if(! $product->inStock()): ?>
                                <span class="inline-block mt-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Out of Stock</span>
                            <?php else: ?>
                                <span class="inline-block mt-2 px-2 py-1 text-xs bg-green-100 text-green-800 rounded">In Stock</span>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-8">
                <?php echo e($products->links()); ?>

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
<?php /**PATH /var/www/job3/resources/views/products/index.blade.php ENDPATH**/ ?>