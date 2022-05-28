<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight text-center">
            {{ __('Lifta Pārvaldnieki') }}
        </h2>
            <x-links.link-service href="{{ route('lift-managers.create') }}">
                Pievienot pārvaldnieku
            </x-links.link-service>
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

                                <x-links.link-info href="{{ route('lift-managers.show', $liftManager) }}">
                                    Detaļas
                                </x-links.link-info>

                                <x-links.link-edit href="{{ route('lift-managers.edit', $liftManager) }}">
                                    Rediģēt
                                </x-links.link-edit>

                                <input type="hidden" class="bg-teal-600">
                                <form class="inline-block" method="post"
                                      action="{{ route('lift-managers.destroy', $liftManager) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-buttons.button-danger onclick="return confirm('Are you sure?')">
                                        Dzēst
                                    </x-buttons.button-danger>
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
