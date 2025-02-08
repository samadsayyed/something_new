@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="flex flex-col items-center justify-center h-screen bg-white">
    <h1 class="text-6xl font-bold text-gray-800">404</h1>
    <p class="text-xl text-gray-600 mt-4">Oops! The page you are looking for doesn’t exist.</p>
    <a href="{{ url('/durud-portal') }}" class="mt-6 px-6 py-3 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600">
        Go to Home
    </a>
</div>
@endsection
    