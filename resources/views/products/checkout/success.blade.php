@extends('layouts.app')

@section('title', 'Payment Success')

@section('content')
<div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="max-w-lg mx-auto text-center">

        {{-- Success Icon --}}
        <div class="flex items-center justify-center w-20 h-20 mx-auto mb-6 rounded-full bg-green-100">
            {{-- Lucide replacement (SVG) --}}
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <h1 class="mb-4 text-3xl font-bold text-gray-900">
            Payment successful
        </h1>

        <p class="mb-6 text-lg text-gray-600">
            Thank you for your purchase. Your order has been confirmed and will be processed shortly.
        </p>

        {{-- Reference --}}
        @if (!empty($reference))
            <div class="p-4 mb-8 rounded-lg bg-gray-50">
                <p class="text-sm text-gray-600">Reference</p>
                <p class="text-lg font-semibold text-gray-900">
                    {{ $reference }}
                </p>
            </div>
        @endif

        <div class="mb-4 text-gray-700">
            You will receive shipping update via email.
        </div>

        <div class="flex flex-col gap-4 sm:flex-row sm:justify-center">
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-medium text-white transition-colors rounded-lg bg-primary-600 hover:bg-primary-700">
                {{-- Shopping bag icon --}}
                <svg class="w-4 h-5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 8h14l-1.5 12h-11L5 8zM9 8V6a3 3 0 016 0v2" />
                </svg>
                Continue shopping
            </a>

            <a href="{{ url('/') }}"
               class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-medium text-white transition-colors rounded-lg bg-primary-600 hover:bg-primary-700">
                {{-- Home icon --}}
                <svg class="w-4 h-5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 12l9-9 9 9M4 10v10h5v-6h6v6h5V10" />
                </svg>
                Back to home
            </a>
        </div>
    </div>
</div>
@endsection
