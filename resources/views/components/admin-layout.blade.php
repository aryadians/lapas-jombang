@props(['header'])

<x-app-layout>
    <x-slot name="header">
        {{ $header }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ $header }}
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>