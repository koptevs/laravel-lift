<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reģisrtēt jaunu pārbaudi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    <form method="post" action="{{ route('inspections.store')  }}">
                        @csrf
                        <div class="grid grid-cols md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label for="lift_id">Lifta reģistrācijas numurs:</label><br>
                                <input type="text" id="lift_id" class="w-full" name="lift_id" value="{{ old('lift_id') }}">
                                @error('reg_number')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>



                            <div>
                                <label for="inspection_date">Inspekcijas datums:</label><br>
                                <input type="text" id="inspection_date" class="w-full" name="inspection_date" value="{{ old('inspection_date') }}">
                                @error('inspection_date')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="inspection_protocol">Protokola numurs:</label><br>
                                <input type="text" id="inspection_protocol" class="w-full" name="inspection_protocol" value="{{ old('inspection_protocol') }}">
                                @error('inspection_protocol')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="inspection_type">Inspeksijas tips:</label><br>
                                <select id="inspection_type" class="w-full" name="inspection_type">
                                    <option  value=""></option>
                                    @foreach($inspectionTypes as $inspectionType)
                                        <option value="{{ $inspectionType }}"> {{ $inspectionType }}</option>
                                    @endforeach
                                </select>
                                @error('inspection_type')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>


                            <div>
                                <label for="inspection_label">Zīme:</label><br>
                                <input id="inspection_label" class="w-full" type="text" name="inspection_label" value="{{ old('inspection_label') }}">
                                <br>
                                @error('inspection_label')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>


                            <div>
                                <label for="inspection_result">Inspekcijas rezultāts:</label><br>
                                <input type="text" id="inspection_result" class="w-full" name="inspection_result"  value="{{ old('inspection_result') }}">
                                @error('inspection_result')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="inspection_participant_1_profession">Person_1 amats:</label><br>
                                <input id="inspection_participant_1_profession" class="w-full" type="text" name="inspection_participant_1_profession"  value="{{ old('inspection_participant_1_profession') }}">
                                <br/>
                                @error('inspection_participant_1_profession')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="inspection_participant_1_name"> Person_1 name:</label><br>
                                <input id="inspection_participant_1_name" class="w-full" type="text" name="inspection_participant_1_name"  value="{{ old('inspection_participant_1_name') }}">
                                <br/>
                                @error('inspection_participant_1_name')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="inspection_participant_2_profession">Person_2 amats:</label><br>
                                <input id="inspection_participant_2_profession" class="w-full" type="text" name="inspection_participant_2_profession"  value="{{ old('inspection_participant_2_profession') }}">
                                <br/>
                                @error('inspection_participant_2_profession')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="inspection_participant_2_name"> Person_2 name:</label><br>
                                <input id="inspection_participant_2_name" class="w-full" type="text" name="inspection_participant_2_name"  value="{{ old('inspection_participant_2_name') }}">
                                <br/>
                                @error('inspection_participant_2_name')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>


                            </div>
                        <div>
                            <label for="incpection_notes"> Neatbilstības:</label><br>
                            <textarea rows="5" cols="100" id="incpection_notes" class="w-full" type="text" name="incpection_notes"  value="{{ old('incpection_notes') }}"></textarea>
                            <br/>
                            @error('incpection_notes')
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror
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
