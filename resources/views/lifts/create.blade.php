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
                        <div class="grid grid-cols md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label for="reg_number">Reg. Number:</label><br>
                                <input type="text" id="reg_number" class="w-full" name="reg_number">
                                @error('reg_number')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="lift_type">Lift type:</label><br>
                                <input id="lift_type" class="w-full" type="text" name="lift_type">
                                @error('lift_type')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="manufacturer_name">Manufacturer:</label><br>
                                <input id="manufacturer_name" class="w-full" type="text" name="manufacturer_name">
                                <br>
                                @error('manufacturer_name')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="manufacture_year">Manufacture year:</label><br>
                                <input id="manufacture_year" class="w-full" type="text" name="manufacture_year">
                                <br/>
                                @error('manufacture_year')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="city"> City:</label><br>
                                <input id="city" class="w-full" type="text" name="city">
                                <br/>
                                @error('city')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>

                                <label for="street"> Street:</label><br>
                                <input id="street" class="w-full" type="text" name="street">
                                <br/>
                                @error('street')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>

                                <label for="house"> House:</label><br>
                                <input id="house" class="w-full" type="text" name="house">
                                <br/>
                                @error('house')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>

                                <label for="entrance"> Entrance:</label><br>
                                <input id="entrance" class="w-full" type="text" name="entrance">
                                <br/>
                                @error('entrance')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>

                                <label for="lift_manager_id"> Lift manager:</label><br>
                                <select id="lift_manager_id" class="w-full" name="lift_manager_id">
                                    @foreach($liftManagers as $liftManager)
                                        <option value="{{ $liftManager->id }}"> {{ $liftManager->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
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
