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
                    Reg. Nr.: <span class="text-lg font-bold">{{ $lift->reg_number }}</span><br>
                    Adrese: <span class="text-lg font-bold">{{ $lift->country }}, {{ $lift->city }},
                        {{ $lift->street }} iela {{ $lift->house }} / {{ $lift->entrance }}</span><br>

                    Lift manager: <span class="text-lg font-bold">{{ $lift->liftManager->name }}, reg.nr. {{ $lift->liftManager->reg_number }}</span><br>
                    Lift type.: <span class="text-lg font-bold">{{ $lift->lift_type }}</span><br>
                    Manufactured: <span class="text-lg font-bold">{{ $lift->manufacture_year }}</span>
                    <br><br>
                    <a href="{{ route('lifts.edit', $lift) }}">
                        <x-button>
                            Edit
                        </x-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
