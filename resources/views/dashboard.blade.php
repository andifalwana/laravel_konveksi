<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">

        <!-- Image Gallery Section -->
        <div class="flex overflow-x-auto space-x-4 mt-4">
            @foreach($images as $image)
                <div class="flex-shrink-0 w-64 bg-white shadow-md rounded-lg overflow-hidden flex flex-col">
                    <img src="{{ asset($image['path']) }}" class="w-full h-48 object-cover" alt="{{ $image['filename'] }}">
                    <div class="p-4 flex flex-col flex-grow">
                        <h5 class="text-lg font-bold truncate">{{ $image['filename'] }}</h5>
                        <a href="{{ route('image.detail', ['filename' => $image['filename']]) }}" class="mt-auto inline-block bg-blue-500 text-white px-4 py-2 rounded">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
