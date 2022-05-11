<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lift') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('lifts.index') }}">
                        <h2 class="text-4xl ">
                            Go to all lifts list.
                        </h2>
                    </a>
                    <br>
                    Reg. Nr.: {{ $lift->reg_number }}<br>
                    Lift manager: {{ $lift->lift_manager->name }}<br>
                    Lift type.: {{ $lift->lift_type }}<br>
                    Manufactured: {{ $lift->manufacture_year }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
