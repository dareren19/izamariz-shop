@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class='px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8'>
    <nav class="mb-6 mt-2">
        <ol class="flex items-center gap-2 text-sm">
            <li class="">
                <a href="{{ route('home') }}" class='text-gray-500 hover:text-primary-600'>
                    Home
                </a>
            </li>
            <li class='text-gray-400'>/</li>
            <li>
                <a href="{{ route('cart.index') }}" class='text-gray-500 hover:text-primary-600'>
                    Cart
                </a>
            </li>
            <li class='text-gray-400'>/</li>
            <li class='font-medium text-gray-900'>Checkout</li>
        </ol>
    </nav>
    
    <a href="{{ route('cart.index') }}"
        class='inline-flex items-center gap-2 mb-6 text-sm text-gray-600 transition-colors hover:text-primary-600'>
        <svg class='w-4 h-5' fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to cart
    </a>
    
    <h1 class='mb-8 text-3xl font-bold text-gray-900'>Checkout</h1>
    
    <form id="checkoutForm" method="POST" action="{{ route('checkout.process') }}">
        @csrf
        <div class='grid gap-8 lg:grid-cols-3'>
            <div class='lg:col-span-2'>
                <div class='p-6 bg-white border border-gray-100 rounded-xl'>
                    <h2 class='mb-6 text-lg font-semibold text-gray-900'>Shipping information</h2>
                    
                    <div class='space-y-4'>
                        <div>
                            <label for="name" class='block mb-1 text-sm font-medium text-gray-700'>
                                Full Name *
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                class='block w-full px-4 py-3 text-gray-900 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500' 
                                placeholder='John Doe' required>
                            @error('name')
                                <p id="name-error" class='mt-1 text-sm text-red-600'>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class='block mb-1 text-sm font-medium text-gray-700'>
                                Email *
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" 
                                class='block w-full px-4 py-3 text-gray-900 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500' 
                                placeholder='john@example.com' required>
                            @error('email')
                                <p id="email-error" class='mt-1 text-sm text-red-600'>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="phone" class='block mb-1 text-sm font-medium text-gray-700'>
                                Phone Number (Optional)
                            </label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" 
                                class='block w-full px-4 py-3 text-gray-900 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500'>
                            @error('phone')
                                <p id="phone-error" class='mt-1 text-sm text-red-600'>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="address" class='block mb-1 text-sm font-medium text-gray-700'>
                                Shipping Address *
                            </label>
                            <textarea name="address" id="address" rows="3" 
                                class='block w-full px-4 py-3 text-gray-900 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500' 
                                required>{{ old('address') }}</textarea>
                            @error('address')
                                <p id="address-error" class='mt-1 text-sm text-red-600'>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class='lg:col-span-1'>
                <div class='sticky p-6 bg-white border border-gray-100 top-24 rounded-xl'>
                    <h2 class='mb-4 text-lg font-bold text-gray-900'>Order Summary</h2>
                    
                    <div class='mb-4 space-y-3'>
                        @foreach($cartItems as $item)
                        <div class='flex items-center justify-between text-sm'>
                            <span class='font-medium text-gray-900 truncate max-w-[180px]'>
                                {{ $item['product']['name'] }} x {{ $item['quantity'] }}
                            </span>
                            <span class='font-medium text-gray-900'>
                                PHP {{ number_format($item['product']['price'] * $item['quantity'], 2) }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class='pt-4 space-y-3 border-t border-gray-100'>
                        <div class='flex items-center justify-between text-sm'>
                            <span class='text-gray-600'>Subtotal</span>
                            <span class='font-medium text-gray-600'>
                                PHP {{ number_format($subtotal, 2) }}
                            </span>
                        </div>
                        <div class='flex items-center justify-between text-sm'>
                            <span class='text-gray-600'>Shipping</span>
                            <span class='font-medium text-gray-600'>Free</span>
                        </div>
                    </div>
                    
                    <div class='pt-4 mt-4 border-t border-gray-100'>
                        <div class='flex items-center justify-between'>
                            <span class='text-lg font-semibold text-gray-900'>Total</span>
                            <span class='text-primary-600 text-lg font-bold'>
                                PHP {{ number_format($subtotal, 2) }}
                            </span>
                        </div>
                    </div>
                    
                    <button type="submit" id="submitBtn" 
                        class='flex items-center justify-center w-full gap-2 px-6 py-3 mt-6 text-sm font-medium text-white bg-primary-600 transition-colors rounded-lg hover:bg-primary-700 disabled:opacity-50 disabled:cursor-not-allowed'>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <span id="submitText">Pay with HitPay</span>
                    </button>
                    
                    <p class='mt-4 text-xs text-center text-gray-500'>
                        You will be redirected to HitPay to complete your payment securely
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('checkoutForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    
    // form.addEventListener('submit', function(e) {
    //     e.preventDefault();
        
    //     // Disable button and show processing
    //     submitBtn.disabled = true;
    //     submitText.textContent = 'Processing...';
        
    //     // Submit form via AJAX
    //     fetch(form.action, {
    //         method: 'POST',
    //         body: new FormData(form),
    //         headers: {
    //             'X-Requested-With': 'XMLHttpRequest',
    //             'Accept': 'application/json'
    //         }
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         if (data.success) {
    //             // Redirect to payment gateway
    //             if (data.redirect_url) {
    //                 window.location.href = data.redirect_url;
    //             }
    //         } else {
    //             // Show validation errors
    //             if (data.errors) {
    //                 Object.keys(data.errors).forEach(field => {
    //                     const errorElement = document.getElementById(`${field}-error`);
    //                     if (errorElement) {
    //                         errorElement.textContent = data.errors[field][0];
    //                         errorElement.classList.remove('hidden');
    //                     }
    //                 });
    //             }
                
    //             // Re-enable button
    //             submitBtn.disabled = false;
    //             submitText.textContent = 'Pay with HitPay';
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error:', error);
    //         submitBtn.disabled = false;
    //         submitText.textContent = 'Pay with HitPay';
    //         alert('An error occurred. Please try again.');
    //     });
        
    //     return false;
    // });
    
    // Clear validation errors on input
    form.querySelectorAll('input, textarea').forEach(element => {
        element.addEventListener('input', function() {
            const errorElement = document.getElementById(`${this.name}-error`);
            if (errorElement) {
                errorElement.textContent = '';
                errorElement.classList.add('hidden');
            }
        });
    });
});
</script>
@endsection