@extends('layouts.app')

@section('title', 'Payment Failed')

@section('content')
<div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="max-w-lg mx-auto text-center">

        {{-- Error Icon --}}
        <div class="flex items-center justify-center w-20 h-20 mx-auto mb-6 rounded-full bg-red-100">
            <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M18 6L6 18M6 6l12 12" />
            </svg>
        </div>

        <h1 class="mb-4 text-3xl font-bold text-gray-900">Payment failed</h1>
        <p class="mb-6 text-lg text-gray-600">
            Unable to process your payment. Please try again or use a different payment method.
        </p>

        {{-- Buttons --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-center">
            <a href="{{ route('cart.index') }}"
               class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-medium text-white transition-colors rounded-lg bg-primary-600 hover:bg-primary-700">
                {{-- Refresh icon --}}
                <svg class="w-4 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 4v6h6M20 20v-6h-6M4 14a8 8 0 0116 0a8 8 0 01-16 0z"/>
                </svg>
                Try Again
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
