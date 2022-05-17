<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a Lift') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="{{ route('lifts.store')  }}">
                        @csrf

                        Reg. Number:
                        <br/>
                        <input type="text" name="reg_number">
                        <br/>

                        Lift type:
                        <br/>
                        <input type="text" name="lift_type">
                        <br/>

                        Manufacturer:
                        <br/>
                        <input type="text" name="manufacturer_name">
                        <br/>

                        Manufacture year:
                        <br/>
                        <input type="text" name="manufacture_year">
                        <br/>

                        Lift manager:
                        <br/>

                        <select name="lift_manager_id">
                            @foreach($liftManagers as $liftManager)
                                <option value="{{ $liftManager->id }}"> {{ $liftManager->name }}</option>
                            @endforeach

                        </select>
                        <br>
                        <br>
                        <x-button>
                            Save
                        </x-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
