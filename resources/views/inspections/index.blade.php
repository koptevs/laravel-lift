<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight text-center">
            {{ __('Liftu pārbaudes') }} <br>
        </h2>
        <a href="{{ route('lifts.create') }}">
            <x-button>
                Pievienot jaunu pārbaudi
            </x-button>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @foreach($inspections as $inspection)
                        <div class="mt-2 mb-4 flex justify-between">
                            <div id="lift-data" class="text-xl">

                                <span class="text-sm">Pārbaudes protokola numurs: </span>
                                <span class="text-lg font-bold">{{ $inspection->inspection_protocol }}</span>
                                <br>

                                <span class="text-sm">Lifta adrese: </span>
                                {{ $inspection->lift->street }} iela {{ $inspection->lift->house }}
                                / {{ $inspection->lift->entrance }}, {{ $inspection->lift->city }}
                                , {{ $inspection->lift->country }}, {{ $inspection->lift->postal_code }}

                                <a href="{{ route('proto', $inspection) }}" target="_blank">
                                    <x-button-info>
                                        Rādīt protokolu
                                    </x-button-info>
                                </a>

                            </div>
                            {{--                            <div id="controls">--}}

                            {{--                                <a href="{{ route('lifts.show', $lift) }}">--}}
                            {{--                                    <x-button-info>--}}
                            {{--                                        Show details--}}
                            {{--                                    </x-button-info>--}}
                            {{--                                </a>--}}
                            {{--                                <a href="{{ route('lifts.edit', $lift) }}">--}}
                            {{--                                    <x-button>--}}
                            {{--                                        Edit--}}
                            {{--                                    </x-button>--}}
                            {{--                                </a>--}}
                            {{--                                <form class="inline-block" method="post" action="{{ route('lifts.destroy', $lift) }}">--}}
                            {{--                                    @csrf--}}
                            {{--                                    @method('DELETE')--}}
                            {{--                                    <x-button-danger onclick="return confirm('Are you sure?')">--}}
                            {{--                                        Delete--}}
                            {{--                                    </x-button-danger>--}}
                            {{--                                </form>--}}
                            {{--                            </div>--}}
                        </div>
                        <hr>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
