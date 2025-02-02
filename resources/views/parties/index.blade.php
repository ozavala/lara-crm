
// resources/views/parties/index.blade.php
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
                                
                                <th>Party ID</th>
                                <th>Party Type</th>
                                <th>Person/Organization</th>
                            </x-slot>
                            <x-slot name="body">
                            @foreach($results as $result)
                            <x-table.row>
                                <x-table.cell>{{ $result->id }}</x-table.cell>
                                <x-table.cell>{{ $result->party_type }}</x-table.cell>
                                <x-table.cell>
                                    @if($result->party_type === App\Enums\PartyType::PERSON)
                                        {{ $result->person_first_name }} {{ $result->person_last_name }}
                                    
                                    @elseif($result->party_type === App\Enums\PartyType::ORGANIZATION)
                                        {{ $result->organization_name }}                        
                                    @endif                  
                                    
                                
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
    

</x-app-layout>