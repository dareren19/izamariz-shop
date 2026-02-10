{{-- resources/views/cart.blade.php --}}
@extends('layouts.app')

@section('title', 'Shopping Cart - IzaMarizShop')

@section('content')
<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    {{-- Breadcrumb Navigation --}}
    <nav class="mb-6">
        <ol class="flex items-center gap-2 text-sm">
            <li>
                <a href="{{ url('/') }}" class="text-gray-500 hover:text-primary-600">
                    Home
                </a>
            </li>
            <li class="text-gray-400">/</li>
            <li class="font-medium text-gray-900">Cart</li>
        </ol>
    </nav>
    
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-900">
            Shopping Cart
        </h1>
        @if(!empty($cartItems) && count($cartItems) > 0)
            <form method="POST" action="{{ route('cart.clear') }}" id="clear-cart-form" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            <button type="button" 
                    onclick="if(confirm('Clear cart?')) document.getElementById('clear-cart-form').submit()"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-600 transition-colors rounded-lg hover:bg-red-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Clear Cart
            </button>
        @endif
    </div>

    {{-- Empty Cart State --}}
    @if(empty($cartItems) || count($cartItems) === 0)
        <div class="py-16 text-center">
            <svg class="w-24 h-24 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h2 class="mb-2 text-xl font-semibold text-gray-900">
                Your cart is empty.
            </h2>
            <p class="mb-6 text-gray-500">
                Looks like you haven't added any items yet.
            </p>
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 text-sm font-medium text-white transition-colors rounded-lg bg-primary-600 hover:bg-primary-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Continue shopping
            </a>
        </div>
    @else
        {{-- Cart with Items --}}
        <div class="grid gap-8 lg:grid-cols-3">
            {{-- Cart Items List --}}
            <div class="lg:col-span-2">
                <div class="space-y-4">
                    @foreach($cartItems as $item)
                        {{-- Include the partial --}}
                        @include('products.cart.cart-item', ['item' => $item])
                    @endforeach
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 text-sm font-medium text-white transition-colors rounded-lg bg-primary-600 hover:bg-primary-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Continue shopping
                    </a>
                </div>
            </div>
            
            {{-- Order Summary --}}
            <div class="lg:col-span-1">
                <div class="sticky p-6 bg-white border border-gray-100 rounded-xl top-24">
                    <h2 class="mb-4 text-lg font-semibold text-gray-600">
                        Order Summary
                    </h2>
                    
                    <div class="space-y-3">
                        {{-- Subtotal --}}
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">
                                Subtotal ({{ count($cartItems) }} items)
                            </span>
                            <span class="text-gray-600">
                                PHP {{ number_format($subtotal, 2) }}
                            </span>
                        </div>
                        
                        {{-- Shipping --}}
                        <div class="pt-4 mt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-semibold text-gray-900">
                                    Shipping
                                </span>
                                <span class="text-lg font-semibold text-gray-600">
                                    @if($subtotal >= 1000)
                                        FREE
                                    @else
                                        PHP 50.00
                                    @endif
                                </span>
                            </div>
                            @if($subtotal >= 1000)
                                <p class="mt-1 text-xs text-green-600">
                                    🎉 Free shipping on orders over PHP 1,000
                                </p>
                            @endif
                        </div>
                        
                        {{-- Total --}}
                        <div class="pt-4 mt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-semibold text-gray-900">Total</span>
                                <span class="text-lg font-bold text-primary-600">
                                    PHP {{ number_format($subtotal, 2) }}
                                </span>
                            </div>
                        </div>
                        
                        {{-- Checkout Button --}}
                        <div>
                            <a href="{{route('checkout.index')}}"
                               class="flex items-center justify-center w-full gap-2 px-6 py-3 mt-6 font-medium text-white bg-primary-600 rounded-lg transition-colors hover:bg-primary-700">
                                Proceed to Checkout
                            </a>
                            <p class="mt-4 text-xs text-center text-gray-500">
                                Secure checkout
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection