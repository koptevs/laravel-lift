<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mainīt lifta datus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="{{ route('lifts.update', $lift)  }}">
                        @method('PUT')
                        @csrf

                        <div class="grid grid-cols md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                            <div>
                                <label for="reg_number">Reģistrācijas numurs:</label><br>
                                <input type="text" id="reg_number" class="w-full" name="reg_number"
                                       value="{{ $lift->reg_number }}">
                                @error('reg_number')
                                <div class=" text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="lift_type">Lifta tips:</label><br>
                                <select id="lift_type" class="w-full" name="lift_type">
                                    <option value="{{ $lift->lift_type }}">{{ $lift->lift_type }}</option>
                                    @foreach($liftTypes as $liftType)
                                        <option value="{{ $liftType }}"> {{ $liftType }}</option>
                                    @endforeach
                                </select>
                                @error('lift_type')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="load_capacity">Celtspēja:</label><br>
                                <input type="text" id="load_capacity" class="w-full" name="load_capacity"
                                       value="{{ $lift->load_capacity }}">
                                @error('load_capacity')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="speed">Ātrums:</label><br>
                                <input type="text" id="speed" class="w-full" name="speed" value="{{ $lift->speed }}">
                                @error('speed')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="manufacturer_name">Ražotājs:</label><br>
                                <input id="manufacturer_name" class="w-full" type="text" name="manufacturer_name"
                                       value="{{ $lift->manufacturer_name }}">
                                <br>
                                @error('manufacturer_name')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="factory_number">Ražotāja numurs:</label><br>
                                <input type="text" id="factory_number" class="w-full" name="factory_number"
                                       value="{{ $lift->factory_number }}">
                                @error('factory_number')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="installer">Uzstādītājs:</label><br>
                                <input type="text" id="installer" class="w-full" name="installer"
                                       value="{{ $lift->installer }}">
                                @error('installer')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="manufacture_year">Uzstadīšanas gads:</label><br>
                                <input id="manufacture_year" class="w-full" type="text" name="manufacture_year"
                                       value="{{ $lift->manufacture_year }}">
                                <br/>
                                @error('manufacture_year')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="country"> Valsts:</label><br>
                                <input id="country" class="w-full" type="text" name="country"
                                       value="{{ $lift->country }}">
                                <br/>
                                @error('country')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="city"> Pilsēta:</label><br>
                                <input id="city" class="w-full" type="text" name="city" value="{{ $lift->city }}">
                                <br/>
                                @error('city')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="city_region">Pilsētas rajons:</label><br>
                                <select id="city_region" class="w-full" name="city_region">
                                    <option value="{{ $lift->city_region }}">{{ $lift->city_region }}</option>

                                    @foreach($cityRegions as $cityRegion)

                                        <option value="{{ $cityRegion }}"> {{ $cityRegion }}</option>
                                    @endforeach


                                </select>
                                @error('city_region')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="street"> Ielas nosaukums:</label><br>
                                <input id="street" class="w-full" type="text" name="street" value="{{ $lift->street }}">
                                <br/>
                                @error('street')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="house"> Ēkas numurs:</label><br>
                                <input id="house" class="w-full" type="text" name="house" value="{{ $lift->house }}">
                                <br/>
                                @error('house')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="entrance"> Ieējas numurs:</label><br>
                                <input id="entrance" class="w-full" type="text" name="entrance"
                                       value="{{ $lift->entrance }}">
                                <br/>
                                @error('entrance')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="postal_code"> Pasta indeks:</label><br>
                                <input id="postal_code" class="w-full" type="text" name="postal_code"
                                       value="{{ $lift->postal_code }}">
                                <br/>
                                @error('postal_code')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="floors_total"> Stāvu skaits:</label><br>
                                <input id="floors_total" class="w-full" type="text" name="floors_total"
                                       value="{{ $lift->floors_total }}">
                                <br/>
                                @error('floors_total')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="floors_serviced"> Apkalp. stāvu skaits:</label><br>
                                <input id="floors_serviced" class="w-full" type="text" name="floors_serviced"
                                       value="{{ $lift->floors_serviced }}">
                                <br/>
                                @error('floors_serviced')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="lift_manager_id"> Lifta pārvaldnieks:</label><br>
                                <select id="lift_manager_id" class="w-full" name="lift_manager_id">
                                    <option value="{{ $lift->lift_manager_id }}">{{ $liftManagers->get($lift->lift_manager_id - 1)->name}}</option> //TODO how does it works?!
                                    @foreach($liftManagers as $liftManager)
                                        <option value="{{ $liftManager->id }}"> {{ $liftManager->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <x-button>
                            Save
                        </x-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
