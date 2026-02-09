@php

    $cart = session('cart', []);
    $cartItemsCount = collect($cart)->reduce(function($acc, $item) {
        return $acc + ($item['quantity'] ?? 0);
    }, 0);

    $currentPath = request()->path();
@endphp
<header id="main-header">
     <div class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm backdrop-blur-sm">
        <div class="px-4 mx-auto max-w-7x1 sm:p-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-6">
                    <a href="" class="text-2xl font-bold text-primary-600">
                        IzaMarizShop
                    </a>
                    <nav class="hidden md:flex md:items-center md:gap-6" role="navigation">
                        <a href="/" class="text-sm font-medium text-gray-700 transition-colors hover:text-primary-600">
                            Home
                        </a>
                        <a href={{ url('/products') }} class="text-sm font-medium text-gray-700 transition-colors hover:text-primary-600">
                            Products
                        </a>
                    </nav>

                </div>
                
                <!-- Right: Actions -->
                <div class="flex items-center gap-4">
                    <!-- Search Button -->
                    <button type="button" id="search-toggle-btn"
                            class="p-2 text-gray-600 rounded-lg hover:text-primary-600 hover:bg-gray-100">
                        <i class="fas fa-search w-5 h-5"></i>
                    </button>
                    
                    <!-- Cart -->
                    <a href="{{ url('/cart') }}" 
                       class="relative p-2 text-gray-600 rounded-lg hover:text-primary-600 hover:bg-gray-100">
                        <i class="fas fa-shopping-cart w-5 h-5"></i>
                        @if($cartItemsCount > 0)
                            <span class="absolute flex items-center justify-center w-5 h-5 text-xs font-medium text-white rounded-full -top-1 -right-1 bg-primary-600">
                                {{ $cartItemsCount }}
                            </span>
                        @endif
                    </a>
                    
                    <!-- Mobile Menu Toggle -->
                    <button type="button" id="menu-toggle-btn"
                            class="md:hidden p-2 text-gray-600 rounded-lg hover:text-primary-600 hover:bg-gray-100">
                        <i id="menu-open-icon" class="fas fa-bars w-5 h-5"></i>
                        <i id="menu-close-icon" class="fas fa-times w-5 h-5 hidden"></i>
                    </button>
                </div>
            </div>
            
            <!-- Search Bar -->
            <div id="search-container" class="hidden py-4 border-t border-gray-100">
                <form action="{{ url('/search') }}" method="GET" class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                    <input type="text" name="q" id="search-input"
                           placeholder="Search products..."
                           class="w-full py-3 pl-10 pr-4 text-gray-900 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </form>
            </div>
            
            <!-- Mobile Menu -->
            <nav id="mobile-menu" class="hidden py-4 border-t border-gray-100 md:hidden">
                <div class="flex flex-col space-y-3">
                    <a href="{{ url('/') }}" 
                       class="flex items-center py-2 text-sm font-medium text-gray-700 hover:text-primary-600 {{ $currentPath === '/' ? 'text-primary-600' : '' }}">
                        <i class="fas fa-home mr-3 w-4 h-4"></i>
                        <span>Home</span>
                    </a>
                    
                    <a href="{{ url('/products') }}" 
                       class="flex items-center py-2 text-sm font-medium text-gray-700 hover:text-primary-600 {{ str_starts_with($currentPath, 'products') ? 'text-primary-600' : '' }}">
                        <i class="fas fa-box mr-3 w-4 h-4"></i>
                        <span>Products</span>
                    </a>
                    
                    {{-- <a href="{{ url('/categories') }}" 
                       class="flex items-center py-2 text-sm font-medium text-gray-700 hover:text-primary-600 {{ str_starts_with($currentPath, 'categories') ? 'text-primary-600' : '' }}">
                        <i class="fas fa-tags mr-3 w-4 h-4"></i>
                        <span>Categories</span>
                    </a> --}}
                    
                    <a href="{{ url('/about') }}" 
                       class="flex items-center py-2 text-sm font-medium text-gray-700 hover:text-primary-600 {{ str_starts_with($currentPath, 'about') ? 'text-primary-600' : '' }}">
                        <i class="fas fa-info-circle mr-3 w-4 h-4"></i>
                        <span>About</span>
                    </a>
                </div>
            </nav>
        </div>
    </div>
</header>

