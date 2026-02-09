@extends('layouts.app')

@section('title', '404 - Page Not Found')

@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0" role="main">
    <div class="">
        <div class="max-w-md w-full space-y-8 text-center">
            <div>
                <h1 class="text-9xl font-bold text-white">404</h1>
                <h2 class="mt-6 text-3xl font-extrabold text-white">
                    Page not found
                </h2>
                <p class="mb-6 mt-6 text-sm text-white text-xl">
                    Sorry, we couldn't find the page you're looking for.
                </p>
            </div>
            
            <div class="space-y-4">
                <a href="{{ url('/') }}" 
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Go back home
                </a>
                
                
            </div>
        </div>
    </div>
</div>    
@endsection