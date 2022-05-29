<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight text-center">
            {{ __('Statistika') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-xl mb-2">Reģistrēto liftu skaits: <span class="font-bold">{{ $lifts_total }}</span></p>
                    <p class="text-xl mb-2">Liftu pārvaldnieku skaits: <span class="font-bold">{{ $lift_managers_total }}</span></p>
                    <p class="text-xl">Pārbaudes kopā: <span class="font-bold">{{ $inspections_total }}</span></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
