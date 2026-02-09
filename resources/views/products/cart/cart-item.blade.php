{{-- 
@php
    // Calculate cart totals from session
    $cart = session('cart', []);
    $cartItems = [];
    $subtotal = 0;
    
    foreach ($cart as $item) {
        $product = \App\Models\Product::find($item['id'] ?? null);
        if ($product) {
            $itemTotal = $product->price * ($item['quantity'] ?? 1);
            $subtotal += $itemTotal;
            
            $cartItems[] = [
                'product' => $product,
                'quantity' => $item['quantity'] ?? 1,
                'item_total' => $itemTotal
            ];
        }
    }
    
    $cartCount = collect($cart)->sum('quantity');
@endphp

@section('content')
<div class='px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8'>
    <!-- Breadcrumb -->
    <nav class='mb-6'>
        <ol class='flex items-center gap-2 text-sm'>
            <li>
                <a href='/' class='text-gray-500 hover:text-primary-600'>
                    Home
                </a>
            </li>
            <li class='text-gray-400'>/</li>
            <li class='font-medium text-gray-900'>Cart</li>
        </ol>
    </nav>
    
    <!-- Header -->
    <div class='flex items-center justify-between mb-8'>
        <h1 class='text-3xl font-bold text-gray-900'>
            Shopping Cart
        </h1>
        @if(count($cartItems) > 0)
            <form method="POST" action="{{ route('cart.clear') }}" id="clear-cart-form" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            <button onclick="clearCart()" class='inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-600 transition-colors rounded-lg hover:bg-red-50'>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Clear Cart
            </button>
        @endif
    </div>

    @if(count($cartItems) === 0)
        <!-- Empty Cart -->
        <div class='py-16 text-center'>
            <svg class='w-24 h-24 mx-auto mb-4 text-gray-300' fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <h2 class='mb-2 text-xl font-semibold text-gray-900'>
                Your cart is empty.
            </h2>
            <p class='mb-6 text-gray-500'>
                Looks like you haven't added any items yet.
            </p>
            <a href="{{ route('products.index') }}" class='inline-flex items-center gap-2 px-6 py-3 text-sm font-medium text-white transition-colors rounded-lg bg-primary-600 hover:bg-primary-700'>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Continue shopping
            </a>
        </div>
    @else
        <!-- Cart with Items -->
        <div class='grid gap-8 lg:grid-cols-3'>
            <!-- Cart Items -->
            <div class='lg:col-span-2'>
                <div class='space-y-4'>
                    @foreach($cartItems as $cartItem)
                        @php
                            $product = $cartItem['product'];
                            $quantity = $cartItem['quantity'];
                            $itemTotal = $cartItem['item_total'];
                        @endphp
                        
                        <div class='p-6 bg-white border border-gray-200 rounded-xl'>
                            <div class='flex gap-6'>
                                <!-- Product Image -->
                                <div class='flex-shrink-0'>
                                    <a href="{{ route('products.show', $product) }}">
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                                             class='object-cover w-24 h-24 rounded-lg'>
                                    </a>
                                </div>
                                
                                <!-- Product Details -->
                                <div class='flex-1'>
                                    <div class='flex justify-between'>
                                        <div>
                                            <h3 class='font-medium text-gray-900'>
                                                <a href="{{ route('products.show', $product) }}" class='hover:text-primary-600'>
                                                    {{ $product->name }}
                                                </a>
                                            </h3>
                                            @if($product->brand)
                                                <p class='mt-1 text-sm text-gray-500'>{{ $product->brand }}</p>
                                            @endif
                                            <p class='mt-2 font-medium text-primary-600'>
                                                PHP {{ number_format($product->price, 2) }}
                                            </p>
                                        </div>
                                        
                                        <!-- Item Total -->
                                        <div class='text-right'>
                                            <p class='font-medium text-gray-900'>
                                                PHP {{ number_format($itemTotal, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Quantity Controls -->
                                    <div class='flex items-center justify-between mt-6'>
                                        <!-- Quantity Form -->
                                        <form method="POST" action="{{ route('cart.update', $product->id) }}" class="flex items-center">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <div class='flex items-center border border-gray-300 rounded-lg'>
                                                <button type="submit" name="action" value="decrease" 
                                                        class='p-2 text-gray-600 transition-colors hover:text-primary-600 disabled:text-gray-300 disabled:cursor-not-allowed'
                                                        {{ $quantity <= 1 ? 'disabled' : '' }}>
                                                    -
                                                </button>
                                                
                                                <span class='w-12 text-center font-medium text-gray-900'>
                                                    {{ $quantity }}
                                                </span>
                                                
                                                <button type="submit" name="action" value="increase" 
                                                        class='p-2 text-gray-600 transition-colors hover:text-primary-600 disabled:text-gray-300 disabled:cursor-not-allowed'
                                                        {{ $quantity >= $product->stock ? 'disabled' : '' }}>
                                                    +
                                                </button>
                                            </div>
                                        </form>
                                        
                                        <!-- Remove Form -->
                                        <form method="POST" action="{{ route('cart.remove', $product) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class='inline-flex items-center gap-2 text-sm font-medium text-red-600 transition-colors hover:text-red-800'>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Continue Shopping -->
                <div class='mt-6'>
                    <a href='{{ route('products.index') }}'
                       class='inline-flex items-center gap-2 px-6 py-3 text-sm font-medium text-white transition-colors rounded-lg bg-primary-600 hover:bg-primary-700'>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Continue shopping
                    </a>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class='lg:col-span-1'>
                <div class='sticky p-6 bg-white border border-gray-200 top-24 rounded-xl'>
                    <h2 class='mb-4 text-lg font-semibold text-gray-900'>
                        Order summary
                    </h2>
                    
                    <div class='space-y-3'>
                        <!-- Subtotal -->
                        <div class='flex items-center justify-between text-sm'>
                            <span class='text-gray-600'>
                                Subtotal ({{ count($cartItems) }} items)
                            </span>
                            <span class='font-medium text-gray-900'>
                                PHP {{ number_format($subtotal, 2) }}
                            </span>
                        </div>
                        
                        <!-- Shipping -->
                        <div class='pt-4 mt-4 border-t border-gray-200'>
                            <div class='flex items-center justify-between'>
                                <span class='text-lg font-semibold text-gray-900'>
                                    Shipping
                                </span>
                                <span class='text-lg font-semibold text-primary-600'>
                                    Free
                                </span>
                            </div>
                        </div>
                        
                        <!-- Total -->
                        <div class='pt-4 mt-4 border-t border-gray-200'>
                            <div class='flex items-center justify-between'>
                                <span class='text-lg font-semibold text-gray-900'>Total</span>
                                <span class='text-xl font-bold text-primary-600'>
                                    PHP {{ number_format($subtotal, 2) }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Checkout Button -->
                        <div>
                            <a href="/" 
                               class='flex items-center justify-center w-full gap-2 px-6 py-3 mt-6 font-medium text-white bg-primary-600 rounded-lg transition-colors hover:bg-primary-700'>
                                Proceed to checkout
                            </a>
                            <p class='mt-4 text-xs text-center text-gray-500'>
                                Secure checkout
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- JavaScript -->
<script>
function clearCart() {
    if (confirm('Are you sure you want to clear your cart? This action cannot be undone.')) {
        document.getElementById('clear-cart-form').submit();
    }
}

// Update cart count in header
function updateCartCount(count) {
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = count;
        cartCountElement.style.display = count > 0 ? 'flex' : 'none';
    }
}


</script>
@endsection --}}













{{-- resources/views/products/cart/cart-item.blade.php --}}
{{-- THIS IS A PARTIAL COMPONENT, NOT A FULL PAGE --}}

@php
    $product = $item['product'];
    $quantity = $item['quantity'];
    $itemTotal = $item['item_total'];
@endphp



<div class="p-6 bg-white border border-gray-200 rounded-xl">
    <div class="flex gap-6">
        <!-- Product Image -->
        <div class="flex-shrink-0">
            <a href="{{ route('products.show', $product) }}">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                     class="object-cover w-24 h-24 rounded-lg">
            </a>
        </div>
        
        <!-- Product Details -->
        <div class="flex-1">
            <!-- Top row: Product name and total price -->
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h3 class="font-medium text-gray-900">
                        <a href="{{ route('products.show', $product) }}" class="hover:text-primary-600">
                            {{ $product->name }}
                        </a>
                    </h3>
                    @if($product->brand)
                        <p class="mt-1 text-sm text-gray-500">{{ $product->brand }}</p>
                    @endif
                </div>
                
                <!-- Item Total -->
                <div class="text-right">
                    <p class="font-medium text-gray-900">
                        PHP {{ number_format($itemTotal, 2) }}
                    </p>
                </div>
            </div>
            
            <!-- Bottom row: Price, quantity controls, and remove button -->
            <div class="flex items-center justify-between">
                <!-- Left: Price and quantity -->
                <div class="flex items-center gap-6">
                    <!-- Price -->
                    <p class="font-medium text-primary-600">
                        PHP {{ number_format($product->price, 2) }}
                    </p>
                    
                    <!-- Quantity Controls -->
                    <form method="POST" action="{{ route('cart.update', $product->id) }}" class="flex items-center">
                        @csrf
                        @method('PATCH')
                        
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button type="submit" name="action" value="decrease" 
                                    class="px-3 py-1 text-gray-600 transition-colors hover:text-primary-600 disabled:text-gray-300 disabled:cursor-not-allowed"
                                    {{ $quantity <= 1 ? 'disabled' : '' }}>
                                -
                            </button>
                            
                            <span class="w-12 text-center font-medium text-gray-900">
                                {{ $quantity }}
                            </span>
                            
                            <button type="submit" name="action" value="increase" 
                                    class="px-3 py-1 text-gray-600 transition-colors hover:text-primary-600 disabled:text-gray-300 disabled:cursor-not-allowed"
                                    {{ $quantity >= $product->stock ? 'disabled' : '' }}>
                                +
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Right: Remove button -->
                <form method="POST" action="{{ route('cart.remove', $product) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 text-sm font-medium text-red-600 transition-colors hover:text-red-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Remove
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


















