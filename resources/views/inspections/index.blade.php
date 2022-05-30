<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight text-center">
            {{ __('Liftu pārbaudes') }} <br>
        </h2>
        <a href="{{ route('inspections.create') }}">
            <x-button>
                Pievienot jaunu pārbaudi
            </x-button>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">

                    <table class="table-auto w-full">
                        <thead class="bg-indigo-50">
                        <tr>
                            <th class="p-3 text-center">Pārbaudes<br>datums</th>
                            <th class="p-3 text-center">Pārbaudes <br>protokola numurs</th>
                            <th class="p-3 text-center">Lifta<br>numurs reģistrā</th>
                            <th class="p-3 text-center">Lifta adrese</th>
                            <th class="p-3 text-center"></th>
                            <th class="p-3 text-center"></th>
                            <th class="p-3 text-center"></th>
                            <th class="p-3 text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($inspections as $inspection)
                            <tr @class([
                                'bg-stone-100' => $loop->even
                                ])>
                                <?php
                                $d = new DateTime($inspection->inspection_date);
                                ?>
                                <td class="text-center p-2">{{ $d->format('d.m.Y') }}</td>
                                <td class="text-center p-2">{{ $inspection->inspection_protocol }}</td>
                                <td class="text-center p-2">{{ $inspection->lift->reg_number }}</td>
                                <td class="text-left p-2">{{ $inspection->lift->street }}
                                    iela {{ $inspection->lift->house }}
                                    / {{ $inspection->lift->entrance }}, {{ $inspection->lift->city }}
                                    , {{ $inspection->lift->country }}, {{ $inspection->lift->postal_code }}
                                </td>


                                <td class="text-center p-0">

                                    <x-links.link-info href="{{ route('inspections.show', $inspection) }}">
                                        Detaļas
                                    </x-links.link-info>

                                </td>
                                <td class="text-center pl-1">

                                    <x-links.link-edit href="{{ route('inspections.edit', $inspection) }}">
                                        Rediģēt
                                    </x-links.link-edit>

                                </td>
                                <td class="text-center pl-1">
                                    <form class="inline-block" method="post"
                                          action="{{ route('inspections.destroy', $inspection) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-buttons.button-danger onclick="return confirm('Are you sure?')">
                                            Dzēst
                                        </x-buttons.button-danger>
                                    </form>
                                </td>
                                <td class="text-center pl-1">

                                    <x-links.link-service href="{{ route('proto', $inspection) }}" target="_blank">
                                        Protokols
                                    </x-links.link-service>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


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

            </div>
        </div>
    </div>
    </div>
</x-app-layout>
