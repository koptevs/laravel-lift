<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Lift Manager') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('lift-managers.index') }}">
                        <h2 class="text-4xl ">
                            Go to all lift managers list.
                        </h2>
                    </a>
                    <br>
                    Name: {{ $lift_manager->name }} <br>
                    Address: {{ $lift_manager->address }} <br>
                    Reg . number: {{ $lift_manager->reg_number }}
                    <br><br>
                    <a href="{{ route('lift-managers.edit', $lift_manager) }}">
                        <x-button>
                            Edit
                        </x-button>
                    </a>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
