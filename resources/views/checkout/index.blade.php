<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Shipping & Payment</h3>
                    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                        @csrf

                        <div class="mb-4">
                            <label for="customer_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('customer_name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="customer_email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('customer_email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="tel" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('customer_phone')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700">Address</label>
                            <textarea name="shipping_address" id="shipping_address" rows="3" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="shipping_division" class="block text-sm font-medium text-gray-700">Shipping Division (EMS)</label>
                            <select name="shipping_division" id="shipping_division" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division }}" {{ old('shipping_division', 'Dhaka') === $division ? 'selected' : '' }}>{{ $division }} — BDT {{ number_format($emsRates[$division], 2) }}</option>
                                @endforeach
                            </select>
                            @error('shipping_division')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                            <div class="mt-2 space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="cod" {{ old('payment_method') === 'cod' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500" required>
                                    <span class="ml-2">Cash on Delivery (COD)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="mobile_banking" {{ old('payment_method') === 'mobile_banking' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500" required>
                                    <span class="ml-2">Mobile Banking (Sandbox)</span>
                                </label>
                            </div>
                            @error('payment_method')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 font-semibold">
                            Place Order
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h3>
                    <div class="space-y-4">
                        @foreach ($items as $item)
                            <div class="flex justify-between text-sm">
                                <span>{{ $item['product']->name }} ({{ $item['variant']->size }}) × {{ $item['quantity'] }}</span>
                                <span>BDT {{ number_format($item['line_total'], 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 pt-4 border-t space-y-2">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span id="summary-subtotal">BDT {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>EMS Shipping</span>
                            <span id="summary-shipping">BDT {{ number_format($shippingCost, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-xl font-bold text-gray-900 pt-2 border-t">
                            <span>Total</span>
                            <span id="summary-total">BDT {{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const rates = @json($emsRates);
        const subtotal = {{ $subtotal }};

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
</x-app-layout>
