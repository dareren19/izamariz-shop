@props(['products' => [], 'title' => null])

@if(!$products || count($products) === 0)
    <div class="py-12 text-center">
        <p class="text-gray-500">No items found.</p>
    </div>
@else
    <section>
        @if($title)
            <h2 class="mb-8 text-2xl font-bold text-gray-900">{{ $title }}</h2>
        @endif
        
        <div className='grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4'>
            @foreach($products as $product)
                @include('products.product-card', ['product' => $product])
                
            @endforeach
        </div>       
    </section>
@endif