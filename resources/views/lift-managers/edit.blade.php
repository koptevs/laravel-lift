<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Lift Manager') }} - {{ $liftManager->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="{{ route('lift-managers.update', $liftManager)  }}">
                        @method('PUT')
                        @csrf
                        Lift manager name:
                        <br/>
                        <input type="text" name="name" value="{{ $liftManager->name }}">
                        <br/>

                        <br/>
                        Address:
                        <br/>
                        <input type="text" name="address" value="{{ $liftManager->address }}">
                        <br/>

                        <br/>
                        Reg. Number:
                        <br/>
                        <input type="text" name="reg_number" value="{{ $liftManager->reg_number }}">
                        <br/>

                        <br/>
                        <x-button>
                            Save
                        </x-button>
                        <a href="{{ route('lift-managers.show', $liftManager) }}">
                            <x-button-info>
                                Return to details
                            </x-button-info>
                        </a>
                        <a href="{{ route('lift-managers.index', $liftManager) }}">
                            <x-button-info>
                                Return to all lift managers list
                            </x-button-info>
                        </a>

                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
