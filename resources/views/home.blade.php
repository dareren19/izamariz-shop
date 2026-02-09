@extends('layouts.app')

@section('title', 'Home - IzaMarizShop')

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background: linear-gradient(45deg, transparent 25%, rgba(8, 145, 178, 0.1) 50%, transparent 75%)">
            </div>
        </div>

        <div class="relative px-4 py-24 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:py-32">
            <div class="max-w-2xl">
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    IzaMariz <br />
                    <span class="text-primary-400">
                        Shop
                    </span>
                </h1>
                <p class="mt-6 text-lg text-gray-300">
                    Discover our collection of premium quality Invitation Cards.
                </p>
                <div class="flex flex-wrap gap-4 mt-8">
                    {{-- <a href="{{ route('products.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 text-white transition-colors bg-primary-600 rounded-lg hover:bg-primary-700">
                        Shop now
                    </a>
                    <a href="{{ route('products.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 text-white transition-colors bg-primary-600 rounded-lg hover:bg-primary-700">
                        View Collection
                    </a> --}}
                    <div class="flex flex-wrap justify-center gap-8">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/izamarizonlineshop" target="_blank" class="group">
                            <div
                                class="p-2 transition-all bg-white rounded-full shadow-lg group-hover:scale-110 group-hover:shadow-xl">
                                <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </div>
                            <p class="mt-3 text-sm font-medium text-white">Facebook</p>
                        </a>

                        <!-- Lazada -->
                        <a href="https://www.lazada.com.ph/shop/izamariz-online-shop" target="_blank" class="group">
                            <div
                                class="p-2 transition-all bg-white rounded-full shadow-lg group-hover:scale-110 group-hover:shadow-xl">
                                <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none">
                                    <rect width="24" height="24" rx="12" fill="#0F146E" />
                                    <path d="M7 7V17H9V9H15V7H7Z" fill="white" />
                                    <circle cx="17" cy="7" r="2" fill="#FF6B00" />
                                </svg>
                            </div>
                            <p class="px-2 mt-3 text-sm font-medium text-white">Lazada</p>
                        </a>

                        <!-- Shopee -->
                        <a href="https://shopee.ph/izamariz" target="_blank" class="group">
                            <div
                                class="p-4 transition-all bg-white rounded-full shadow-lg group-hover:scale-110 group-hover:shadow-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                    fill="none" stroke="#ff3b30" stroke-width="1" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M4 7l.867 12.143a2 2 0 0 0 2 1.857h10.276a2 2 0 0 0 2 -1.857l.867 -12.143h-16z" />
                                    <path d="M8.5 7c0 -1.653 1.5 -4 3.5 -4s3.5 2.347 3.5 4" />
                                    <path
                                        d="M9.5 17c.413 .462 1 1 2.5 1s2.5 -.897 2.5 -2s-1 -1.5 -2.5 -2s-2 -1.47 -2 -2c0 -1.104 1 -2 2 -2s1.5 0 2.5 1" />
                                </svg>
                            </div>
                            <p class="px-2 mt-3 text-sm font-medium text-white">Shopee</p>
                        </a>
                    </div>

                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 text-white transition-colors bg-primary-600 rounded-lg hover:bg-primary-700 rounded-xl hover:from-primary-700 hover:to-purple-700 hover:scale-105 hover:shadow-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Start Shopping Now
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="mb-8 text-3xl font-bold text-gray-900">Featured</h1>

        @if ($featuredProducts->count() > 0)

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($featuredProducts as $product)
                    @include('products.product-card', ['product' => $product])
                @endforeach
            </div>

        @endif
        <h1 class="my-8 text-3xl font-bold text-gray-900">New Arrival</h1>
        @if ($newProducts->count() > 0)
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($newProducts as $product)
                    @include('products.product-card', ['product' => $product])
                @endforeach
            </div>
        @endif
        {{-- <div class="py-12 text-center">
            <div class="p-6 mb-4 bg-yellow-50 rounded-lg">
                <p class="text-yellow-700">
                    ⚠️ No new products marked as "New Arrival" in the database.
                </p>
                <p class="mt-2 text-sm text-gray-600">
                    Check your database: Products need <code>is_new = 1</code> or <code>is_new = true</code>
                </p>
            </div>
            <a href="{{ route('products.index') }}" 
               class="inline-block px-6 py-3 font-semibold text-white bg-primary-600 rounded-lg hover:bg-primary-700">
                Browse All Products
            </a>
        </div> --}}

    </div>
@endsection
