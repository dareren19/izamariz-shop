@extends('layouts.app')

@section('title', $product->name . ' - IzaMarizShop')

@section('content')
<form id="cart-form" method="POST" action="{{ route('cart.add') }}" style="display: none;">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="quantity" id="form-quantity" value="1">
</form>
<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    {{-- Breadcrumb Navigation --}}
    <nav class="mb-6 mt-2">
        <ol class="flex items-center gap-2 text-sm">
            <li>
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">
                    Home
                </a>
            </li>
            <li class="text-gray-400">/</li>
            <li>
                <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-primary-600">
                    Products
                </a>
            </li>
            <li class="text-gray-400">/</li>
            <li class="font-medium text-gray-900 truncate max-w-[200px]" title="{{ $product->name }}">
                {{ $product->name }}
            </li>
        </ol>
    </nav>
    
    {{-- Back Button --}}
    <a href="{{ route('products.index') }}" 
       class="inline-flex items-center gap-2 mb-6 text-sm text-gray-600 transition-colors hover:text-primary-600">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Products
    </a>
    
    {{-- Product Details --}}
    <div class="grid gap-8 lg:grid-cols-2">
        {{-- Product Image --}}
        <div class="relative overflow-hidden bg-gray-50 rounded-2xl aspect-square">
            @if($product->is_new)
                <span class="absolute z-10 px-2 py-1 text-xs font-medium text-white rounded top-4 left-4 bg-primary-600">
                    New Arrival
                </span>
            @endif
            <img src="{{ $product->image }}" 
                 alt="{{ $product->name }}" 
                 class="object-cover w-full h-full"
                 onerror="this.src='{{ asset('images/placeholder.jpg') }}'" />
        </div>
        
        {{-- Product Info --}}
        <div class="flex flex-col">
            @if($product->brand)
                <p class="mb-2 text-xs font-medium text-gray-500 uppercase">
                    {{ $product->brand }}
                </p>
            @endif
            
            <h1 class="mb-4 text-3xl font-bold text-gray-900">
                {{ $product->name }}
            </h1>
            
            <p class="mb-6 text-2xl font-bold text-primary-600">
                PHP {{ number_format($product->price, 2) }}
            </p>
            
            {{-- Stock Status --}}
            <div class="mb-6">
                <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full 
                    @if($product->stock > 30)
                        bg-green-100 text-green-800
                    @elseif($product->stock > 0)
                        bg-amber-100 text-amber-800
                    @else
                        bg-red-100 text-red-800
                    @endif">
                    @if($product->stock > 30)
                        In stock
                    @elseif($product->stock > 0)
                        Only {{ $product->stock }} left
                    @else
                        Out of stock
                    @endif
                </span>
            </div>
            
            {{-- Description --}}
            <p class="mb-8 leading-relaxed text-gray-600">
                {{ $product->description }}
            </p>
            
            {{-- Add to Cart Section --}}
            <div class="flex flex-col gap-4 sm:flex-row">
                {{-- Quantity Controls --}}
                <div class="flex items-center border border-gray-300 rounded-lg">
                    <button type="button" 
                            class="p-3 text-gray-600 transition-colors hover:text-primary-600 disabled:text-gray-300 disabled:cursor-not-allowed minus-quantity"
                            
                            id="minus-btn">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                    </button>
                    
                    <span id="quantity-display" class="w-12 text-center font-medium text-gray-900">
                        1
                    </span>
                    
                    <button type="button" 
                            class="p-3 text-gray-600 transition-colors hover:text-primary-600 disabled:text-gray-300 disabled:cursor-not-allowed plus-quantity"
                            
                            id="plus-btn">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </button>
                </div>
                
                {{-- Add to Cart Button --}}
                <button type="button" 
                        
                        id="add-to-cart-btn"
                        class="disabled:cursor-not-allowed disabled:bg-gray-300 flex items-center justify-center w-full gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-primary-600 rounded-lg transition-colors hover:bg-primary-700"
                        {{ $product->stock === 0 ? 'disabled' : '' }}>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span id="add-to-cart-text">
                        {{ $product->stock === 0 ? 'Out of stock' : 'Add to Cart' }}
                    </span>
                </button>
            </div>
            
            {{-- Product Meta --}}
            <div class="pt-8 mt-8 border-t border-gray-200">
                <dl class="space-y-3">
                    <div class="flex gap-2 text-sm">
                        <dt class="font-medium text-gray-900">Category:</dt>
                        <dd class="text-gray-600">{{ $product->category }}</dd>
                    </div>
                    
                    @if($product->brand)
                        <div class="flex gap-2 text-sm">
                            <dt class="font-medium text-gray-900">Brand:</dt>
                            <dd class="text-gray-600">{{ $product->brand }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>
    </div>
    
    {{-- Related Products --}}
    @if($relatedProducts->count() > 0)
        <section class="mt-16">
            <h2 class="mb-8 text-2xl font-bold text-gray-900">
                Related Products
            </h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($relatedProducts as $relatedProduct)
                    @include('products.product-card', ['product'=> $relatedProduct])
                   
                @endforeach
            </div>
        </section>
    @endif
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
    let quantity = 1;
    const productStock = {{ $product->stock }};
    
    const quantityDisplay = document.getElementById('quantity-display');
    const formQuantity = document.getElementById('form-quantity');
    const cartForm = document.getElementById('cart-form');
    const addToCartBtn = document.getElementById('add-to-cart-btn');
    
    // Handle quantity change
    function handleQuantityChange(delta) {
        const newQuantity = quantity + delta;
        if (newQuantity >= 1 && newQuantity <= productStock) {
            quantity = newQuantity;
            quantityDisplay.textContent = quantity;
            formQuantity.value = quantity;
        }
    }
    
    // Handle add to cart (form submission)
    function handleAddToCart() {
        if (productStock === 0) return;
        
        // Update form with current quantity
        formQuantity.value = quantity;
        
        // Submit form (will cause page reload)
        cartForm.submit();
    }
    
    // Event listeners
    document.getElementById('minus-btn').addEventListener('click', () => handleQuantityChange(-1));
    document.getElementById('plus-btn').addEventListener('click', () => handleQuantityChange(1));
    addToCartBtn.addEventListener('click', handleAddToCart);
});
</script>