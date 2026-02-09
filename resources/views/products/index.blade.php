@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <nav class="mb-6">
        <ol class="flex items-center gap-2 text-sm">
            <li><a href="{{ url('/') }}" class="text-gray-500 hover:text-primary-600">Home</a></li>
            <li class="text-gray-400">/</li>
            <li class="font-medium text-gray-900">Products</li>
        </ol>
    </nav>

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-gray-900 font-bold text-xl">Products</h1>
            <p class="mt-1 text-sm text-gray-500">{{ $products->total() }} product{{ $products->total() != 1 ? 's' : '' }} found.</p>
        </div>

        {{-- Mobile filter toggle --}}
        <button type="button" onclick="toggleFilters()" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg lg:hidden hover:bg-gray-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M3 12h18M3 20h18"/>
            </svg>
            Filters
        </button>
    </div>

    <div class="flex gap-8">

        {{-- Sidebar filters --}}
        <aside id="filterSidebar" class="fixed inset-y-0 left-0 z-40 w-72 bg-white p-6 shadow-xl transform -translate-x-full transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0 lg:w-64 lg:shadow-none lg:block">
            <div class="hidden mb-6 lg:flex lg:items-center lg:justify-between font-semibold text-gray-900">
                <h2 class="text-gray-900 font-semibold text-xl ">Filters</h2>
                @if(count($filters) > 0)
                    <a href="{{ route('products.index') }}" class="text-sm text-primary-600 hover:text-primary-700">Clear All</a>
                @endif
            </div>

            <div class="space-y-6">
                {{-- Categories --}}
                <div>
                    <h3 class="mb-3 text-sm font-semibold text-gray-900">Category</h3>
                    <div class="space-y-2">
                        @foreach($categories as $category)
                        <form method="GET" class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="category" value="{{ $category }}">
                            @foreach($filters as $k => $v)
                                @if($k != 'category')
                                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                                @endif
                            @endforeach
                            <button type="submit" class="px-4 flex items-center gap-2 cursor-pointer text-sm text-gray-800 {{ ($filters['category'] ?? '') === $category ? 'font-semibold text-primary-600' : '' }}">
                                {{ $category }}
                            </button>
                        </form>
                        @endforeach
                        {{-- @if(isset($filters['category']))
                            <a href="{{ route('products.index', array_diff_key($filters, ['category'=>1])) }}" class="text-sm text-primary-600 hover:text-primary-700 block mt-1">Clear</a>
                        @endif --}}
                    </div>
                </div>

                {{-- Brands --}}
                <div>
                    <h3 class="mb-3 text-sm font-semibold text-gray-900">Brand</h3>
                    <div class="space-y-2">
                        @foreach($brands as $brand)
                        <form method="GET" class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="brand" value="{{ $brand }}">
                            @foreach($filters as $k => $v)
                                @if($k != 'brand')
                                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                                @endif
                            @endforeach
                            <button type="submit" class=" px-4 flex items-center gap-2 cursor-pointer text-sm text-gray-800 {{ ($filters['brand'] ?? '') === $brand ? 'font-semibold text-primary-600' : '' }}">
                                {{ $brand }}
                            </button>
                        </form>
                        @endforeach
                        {{-- @if(isset($filters['brand']))
                            <a href="{{ route('products.index', array_diff_key($filters, ['brand'=>1])) }}" class="text-sm text-primary-600 hover:text-primary-700 block mt-1">Clear</a>
                        @endif --}}
                    </div>
                </div>
            </div>

        </aside>

        {{-- Overlay for mobile --}}
        <div id="filterOverlay" class="fixed inset-0 z-30 bg-black/30 hidden lg:hidden" onclick="toggleFilters()"></div>

        {{-- Products --}}
        <div class="flex-1">
            @if($products->isEmpty())
                <div class="py-12 text-center">
                    <p>No product found.</p>
                    <a href="{{ route('products.index') }}" class="mt-4 text-sm text-primary-600 hover:text-primary-700 block">Clear filters</a>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($products as $product)
                        @include('products.product-card', ['product' => $product])
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

{{-- Vanilla JS for mobile filters --}}
<script>
function toggleFilters() {
    const sidebar = document.getElementById('filterSidebar');
    const overlay = document.getElementById('filterOverlay');
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}
</script>

@endsection
