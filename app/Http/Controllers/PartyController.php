<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\Person;
use App\Models\Organization;
use App\Enums\PartyType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class PartyController extends Controller
{
    public function index()
    {
        $parties = Party::with(['people', 'organizations'])->latest()->paginate(10);
        return view('parties.index', compact('parties'));
    }

    public function create()
    {
        return view('parties.create', [
            'types' => PartyType::cases()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'party_type' => ['required', new Enum(PartyType::class)],
            // Person fields
            'first_name' => ['required_if:party_type,person', 'string', 'max:255'],
            'last_name' => ['required_if:party_type,person', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            // Organization fields
            'name' => ['required_if:party_type,organization', 'string', 'max:255'],
            'tax_id' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
        ]);

        $party = Party::create([
            'party_type' => $validated['party_type']
        ]);

        if ($party->party_type === PartyType::PERSON) {
            $party->people()->create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'] ?? null,
                'phone' => $validated['phone'] ?? null,
            ]);
        } else {
            $party->organizations()->create([
                'name' => $validated['name'],
                'tax_id' => $validated['tax_id'] ?? null,
                'website' => $validated['website'] ?? null,
            ]);
        }

        return redirect()->route('parties.index')
            ->with('success', 'Party created successfully.');
    }

    public function show(Party $party)
    {
        $party->load(['people', 'organizations']);
        return view('parties.show', compact('party'));
    }

    public function edit(Party $party)
    {
        $party->load(['people', 'organizations']);
        return view('parties.edit', [
            'party' => $party,
            'types' => PartyType::cases()
        ]);
    }

    public function update(Request $request, Party $party)
    {
        $validated = $request->validate([
            'party_type' => ['required', new Enum(PartyType::class)],
            // Person fields
            'first_name.*' => ['required_if:party_type,person', 'string', 'max:255'],
            'last_name.*' => ['required_if:party_type,person', 'string', 'max:255'],
            'email.*' => ['nullable', 'email', 'max:255'],
            'phone.*' => ['nullable', 'string', 'max:255'],
            // Organization fields
            'name.*' => ['required_if:party_type,organization', 'string', 'max:255'],
            'tax_id.*' => ['nullable', 'string', 'max:255'],
            'website.*' => ['nullable', 'url', 'max:255'],
        ]);

        $party->update([
            'party_type' => $validated['party_type']
        ]);

        // Actualizar o crear nuevos registros según el tipo
        if ($party->party_type === PartyType::PERSON) {
            foreach ($request->input('first_name', []) as $key => $value) {
                $party->people()->updateOrCreate(
                    ['id' => $request->input("person_id.$key")],
                    [
                        'first_name' => $value,
                        'last_name' => $request->input("last_name.$key"),
                        'email' => $request->input("email.$key"),
                        'phone' => $request->input("phone.$key"),
                    ]
                );
            }
        } else {
            foreach ($request->input('name', []) as $key => $value) {
                $party->organizations()->updateOrCreate(
                    ['id' => $request->input("organization_id.$key")],
                    [
                        'name' => $value,
                        'tax_id' => $request->input("tax_id.$key"),
                        'website' => $request->input("website.$key"),
                    ]
                );
            }
        }

        return redirect()->route('parties.show', $party)
            ->with('success', 'Party updated successfully.');
    }

    public function destroy(Party $party)
    {
        // Las relaciones se eliminarán automáticamente por la restricción de clave foránea
        $party->delete();

        return redirect()->route('parties.index')
            ->with('success', 'Party deleted successfully.');
    }
} 