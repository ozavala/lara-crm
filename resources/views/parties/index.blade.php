<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Parties') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-2xl">
                        Parties
                    </div>
                </div>

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-lg">
                        <a href="{{ route('parties.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            {{ __('Create Party') }}
                        </a>
                    </div>
                </div>

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-lg">
                        <x-table>
                            <x-slot name="head">
                                <x-table.heading>Party</x-table.heading>
                                <x-table.heading>People</x-table.heading>
                                <x-table.heading>Organizations</x-table.heading>
                            </x-slot>

                            <x-slot name="body">
                                @foreach($parties as $party)
                                    <x-table.row>
                                        <x-table.cell>{{ $party->id }}</x-table.cell>
                                        <x-table.cell>
                                            <ul>
                                                @foreach($party->people as $person)
                                                    <li>{{ $person->first_name }} {{ $person->last_name }}</li>
                                                @endforeach
                                            </ul>
                                        </x-table.cell>
                                        <x-table.cell>
                                            <ul>
                                                @foreach($party->organizations as $organization)
                                                    <li>{{ $organization->name }}</li>
                                                @endforeach
                                            </ul>
                                        </x-table.cell>
                                    </x-table.row>
                                @endforeach
                            </x-slot>
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="py-2">Party</th>
            <th class="py-2">People</th>
            <th class="py-2">Organizations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($parties as $party)
            <tr>
                <td class="border px-4 py-2">{{ $party->id }}</td>
                <td class="border px-4 py-2">
                    <ul>
                        @foreach($party->people as $person)
                            <li>{{ $person->first_name }} {{ $person->last_name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td class="border px-4 py-2">
                    <ul>
                        @foreach($party->organizations as $organization)
                            <li>{{ $organization->name }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</x-app-layout>
