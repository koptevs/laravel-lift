<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Lifts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('lifts.create') }}">
                        <h2 class="text-4xl ">
                            Add a Lift
                        </h2>
                    </a>
                    <br>
                    @foreach($lifts as $lift)
                        <ul>
                            <li>
                                {{ $lift->reg_number }} - {{ $lift->lift_manager?->name }}
                                <span>
                                    <a href="{{ route('lifts.edit', $lift) }}">Edit</a>
                                </span>
                                <form method="post" action="{{ route('lifts.destroy', $lift) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-button-danger onclick="return confirm('Are you sure?')">
                                        Delete
                                    </x-button-danger>
                                </form>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
