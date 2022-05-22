<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight text-center">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl text-gray-600 font-bold text-center">Average site statistics:</h2>
                    <p>Lifts registered: {{ $lifts_total }}</p>
                    <p>Lift managers registered: {{ $lift_managers_total }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
