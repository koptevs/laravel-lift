<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight text-center">
            {{ __('All Lift Managers') }}
        </h2>
        <a href="{{ route('lift-managers.create') }}">
            <x-button>
                Add New Lift Manager
            </x-button>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @foreach($liftManagers as $liftManager)

                        <div class="mt-2 mb-4 flex justify-between">
                            <div id="lift-manager-data" class="text-xl">
                                <a href="{{ route('lift-managers.show', $liftManager) }}">
                                    {{ $liftManager->name }}</a>
                            </div>

                            <div id="controls">

                                <a href="{{ route('lift-managers.show', $liftManager) }}">
                                    <x-button-info>
                                        Show details
                                    </x-button-info>
                                </a>

                                <a href="{{ route('lift-managers.edit', $liftManager) }}">
                                    <x-button>
                                        Edit
                                    </x-button>
                                </a>

                                <form class="inline-block" method="post"
                                      action="{{ route('lift-managers.destroy', $liftManager) }}">
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
