<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Your Store</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .text-primary-600 { color: #2563eb; }
        .bg-primary-600 { background-color: #2563eb; }
        .hover\:bg-primary-700:hover { background-color: #1d4ed8; }
        .hover\:text-primary-600:hover { color: #2563eb; }
        .border-primary-600 { border-color: #2563eb; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="sticky top-0 z-40 bg-white shadow">
        <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-gray-900">YourStore</a>
                </div>
                
                <!-- Navigation -->
                <nav class="flex items-center gap-6">
                    <a href="/" class="text-gray-600 hover:text-primary-600">Home</a>
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-primary-600">Products</a>
                    
                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-primary-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        {{-- @php
                            $cartCount = \App\Http\Controllers\CartController::getCartCount() ?? 0;
                        @endphp --}}
                        @if($cartCount > 0)
                            <span id="cart-count" class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">
                                {{ $cartCount }}
                            </span>
                        @else
                            <span id="cart-count" class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full" style="display: none;">
                                0
                            </span>
                        @endif
                    </a>
                </nav>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    {{-- <footer class="py-8 mt-12 bg-gray-100">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <p class="text-center text-gray-600">&copy; {{ date('Y') }} Your Store. All rights reserved.</p>
        </div>
    </footer> --}}
    
    <!-- Scripts -->
    <script>
        // Global function to update cart count
        function updateCartCount(count) {
            const element = document.getElementById('cart-count');
            if (element) {
                element.textContent = count;
                element.style.display = count > 0 ? 'flex' : 'none';
            }
        }
    </script>
</body>
</html>