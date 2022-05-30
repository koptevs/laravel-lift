<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pārbaude') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('inspections.index') }}">
                        <h2 class="text-4xl ">
                            Go to all inspections.
                        </h2>
                    </a>
                    <br>
                    <p>{{ $inspection->inspection_date }}</p>
                    <p>{{ $inspection->inspection_protocol }}</p>
                    <p>{{ $inspection->inspection_label }}</p>
                    <p>{{ $inspection->inspection_result }}</p>
                    <p>{{ $inspection->inspection_participant_1_profession }}</p>
                    <p>{{ $inspection->inspection_participant_1_name }}</p>
                    <p>{{ $inspection->inspection_participant_2_profession }}</p>
                    <p>{{ $inspection->inspection_participant_2_name }}</p>
                    <p>{{ $inspection->inspection_type }}</p>
                    Lifta Reg. Nr.: <span class="text-lg font-bold">{{ $lift->reg_number }}</span><br>
                    Adrese: <span class="text-lg font-bold">{{ $lift->country }}, {{ $lift->city }},
                        {{ $lift->street }} iela {{ $lift->house }} / {{ $lift->entrance }}</span><br>

                    Lift manager: <span class="text-lg font-bold">{{ $lift->liftManager->name }}, reg.nr. {{ $lift->liftManager->reg_number }}</span><br>
                    Lift type.: <span class="text-lg font-bold">{{ $lift->lift_type }}</span><br>
                    Manufactured: <span class="text-lg font-bold">{{ $lift->manufacture_year }}</span>
                    <h3 class="text-lg font-bold">
                        Pārbaudē konttatētas neatbilstības:
                    </h3>
                    <p>{{ $inspection->incpection_notes }}</p>
                    <br><br>
                    <a href="{{ route('lifts.edit', $lift) }}">
                        <x-button>
                            Edit
                        </x-button>
                        <x-links.link-info href="{{ route('inspections.index') }}" target="_blank">
                            Visas pārbaudes
                        </x-links.link-info>
                        <x-links.link-service href="{{ route('proto', $inspection) }}" target="_blank">
                            Protokols
                        </x-links.link-service>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
