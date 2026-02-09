@props(['product'])


<article
    class="relative bg-white border border-gray-200 rounded-xl overflow-hidden transition-shadow hover:shadow-lg group">

    {{-- Badge for New/Featured --}}
    @if ($product->is_new || $product->is_featured)
        <span class="absolute z-10 px-2 py-1 text-xs font-medium text-white rounded top-3 left-3 bg-primary-600">
            @if ($product->is_featured && $product->is_new)
                Featured & New
            @elseif($product->is_featured)
                Featured
            @else
                New Arrival
            @endif
        </span>
    @endif

    {{-- Product Link --}}
    <a href="{{ route('products.show', $product->slug) }}" class="block">
        {{-- Product Image --}}
        <div class="relative overflow-hidden bg-gray-50 aspect-square">
            <img src="{{ $product->image }}" alt="{{ $product->name }}"
                class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" loading="lazy"
                onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
        </div>

        {{-- Product Info --}}
        <div class="p-4">
            @if ($product->brand)
                <p class="mb-1 text-xs font-medium text-gray-500 uppercase tracking-wide">
                    {{ $product->brand }}
                </p>
            @endif

            <h3 class="mb-2 font-medium text-gray-900 line-clamp-1">
                {{ $product->name }}
            </h3>

            <div class="flex items-center justify-between">
                <p class="text-lg font-semibold text-primary-600">
                    PHP {{ number_format($product->price, 2) }}
                </p>

                @if ($product->stock > 0 && $product->stock <= 40)
                    <span class="text-xs text-amber-600">
                        {{ $product->stock }} items left
                    </span>
                @endif
            </div>
        </div>
    </a>

    {{-- Add to Cart Button --}}
    <div class="px-4 pb-4">
        <form id="cart-form-{{ $product->id }}" method="POST" action="{{ route('cart.add') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1"> <!-- Always add 1 -->

            <!-- Submit button styled as regular button -->
            <button type="submit" id="home-add-to-cart-btn"
                class="flex items-center justify-center w-full gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-primary-600 rounded-lg transition-colors hover:bg-primary-700 disabled:bg-gray-300 disabled:cursor-not-allowed"
                data-product-id="{{ $product->id }}" {{ $product->stock === 0 ? 'disabled' : '' }}>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                {{ $product->stock === 0 ? 'Out of stock' : 'Add to cart' }}
            </button>
        </form>

    </div>
</article>
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     let quantity = 1;
    //     const productStock = {{ $product->stock }};
    //     const homeAddToCartBtn = document.getElementById('home-add-to-cart-btn');
    //     const homeFormQuantity = document.getElementById('home-form-quantity');
    //     const homeCartForm = document.getElementById('home-cart-form');

    //     function handleAddToCart() {
    //         if (productStock === 0) return;

    //         // Update form with current quantity
    //         homeFormQuantity.value = quantity;

    //         // Submit form (will cause page reload)
    //         homeCartForm.submit();
    //     }
    //     homeAddToCartBtn.addEventListener('click', handleAddToCart);
    // });
</script>
