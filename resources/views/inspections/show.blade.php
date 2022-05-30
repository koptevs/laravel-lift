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

                    <h2 class="font-bold text-xl mb-2">Pārbaudes dati</h2>
                    @php  $d = new DateTime($inspection->inspection_date); @endphp
                    <p><span class="font-bold">Inspekcijas datums: </span>{{ $d->format('d.m.Y') }}</p>
                    <p><span class="font-bold">Pārbaudes tips: </span>{{ $inspection->inspection_type }}</p>
                    <p><span class="font-bold">Protokola numurs: </span>{{ $inspection->inspection_protocol }}</p>
                    <p><span class="font-bold">Uzlīmes numurs: </span>{{ $inspection->inspection_label }}</p>
                    <p><span class="font-bold">Pārbaudē piedalījas: </span>{{ $inspection->inspection_participant_1_profession }} {{ $inspection->inspection_participant_1_name }}, {{ $inspection->inspection_participant_2_profession }} {{ $inspection->inspection_participant_2_name }}</p>
                    <p><span class="font-bold">Pārbaudes rezultāts: </span>{{ $inspection->inspection_result }}</p>

                    <h2 class="font-bold text-xl mb-2 mt-4">Lifta dati</h2>

                    <p><span class="font-bold">Lifta tips: </span>{{ $lift->lift_type }}</p>
                    <p><span class="font-bold">Lifta Reg. Nr.: </span>{{ $lift->reg_number }}</p>
                    <p><span class="font-bold">Lifta uzstādīšanas gads: </span>{{ $lift->manufacture_year }}</p>
                    <p><span class="font-bold">Lifts uzstādīts: </span>{{ $lift->country }}, {{ $lift->city }},
                        {{ $lift->street }} iela {{ $lift->house }} / {{ $lift->entrance }}</p>
                    <p><span class="font-bold">Lifta pārvaldnieks: </span>{{ $lift->liftManager->name }}, reg.nr. {{ $lift->liftManager->reg_number }}</p>



                    <h2 class="font-bold text-xl mb-2 mt-4">Pārbaudē konstatētas neatbilstības:</h2>
                    <p class="mb-6">{{ $inspection->incpection_notes }}</p>

                    <a href="{{ route('lifts.edit', $lift) }}">
                        <x-button>
                            Rediģēt
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
