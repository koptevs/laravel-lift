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
                            {{ $liftManager->name }}

                        </h2>
                    </a>
                    <br>
                    Address: {{ $liftManager->address }} <br>
                    Reg . number: {{ $liftManager->reg_number }}
                    <br><br>
                    <a href="{{ route('lift-managers.edit', $liftManager) }}">
                        <x-button>
                            Edit
                        </x-button>
                    </a>
                    <a href="{{ route('lift-managers.index', $liftManager) }}">
                        <x-button-info>
                            Return to all lift managers list
                        </x-button-info>
                    </a>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
