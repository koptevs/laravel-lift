<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight text-center">
            {{ __('All Lifts') }} <br>
        </h2>
        <a href="{{ route('lifts.create') }}">
            <x-button>
                Add New Lift
            </x-button>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @foreach($lifts as $lift)
                        <div class="mt-2 mb-4 flex justify-between">
                            <div id="lift-data" class="text-xl">

                                <span class="text-sm">Reģistrācijas numurs: </span>
                                <span class="text-lg font-bold">{{ $lift->reg_number }}</span>
                                <br>
                                {{--                                - {{ $lift->liftManager->name }}--}}
                                <span class="text-sm">Adrese: </span>
                                {{ $lift->street }} iela {{ $lift->house }} / {{ $lift->entrance }}, {{ $lift->city }}, {{ $lift->country }}, {{ $lift->postal_code }}

                            </div>
                            <div id="controls">

                                <a href="{{ route('lifts.show', $lift) }}">
                                    <x-button-info>
                                        Show details
                                    </x-button-info>
                                </a>
                                <a href="{{ route('lifts.edit', $lift) }}">
                                    <x-button>
                                        Edit
                                    </x-button>
                                </a>
                                <form class="inline-block" method="post" action="{{ route('lifts.destroy', $lift) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-button-danger onclick="return confirm('Are you sure?')">
                                        Delete
                                    </x-button-danger>
                                </form>
                            </div>
                        </div>
                        <hr>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
