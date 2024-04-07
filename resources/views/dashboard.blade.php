<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <input type="text" id="success" value="{{ session('success')}}" readonly hidden>
        <input type="text" id="error" value="{{ session('error')}}" readonly hidden>
        <a href="{{ route('post.view') }}" class="btn btn-primary mb-4">Posts</a>
    </div>
</x-app-layout>