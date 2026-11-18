<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::where('company_id', auth()->user()->company_id)
            ->latest()->paginate(10);

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create', ['client' => new Client()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['company_id'] = auth()->user()->company_id;
        Client::create($data);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado.');
    }

    public function edit(Client $client)
    {
        $this->authorizeCompany($client);
        return view('clients.create', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $this->authorizeCompany($client);
        $client->update($this->validated($request));

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado.');
    }

    public function destroy(Client $client)
    {
        $this->authorizeCompany($client);
        $client->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente removido.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'document' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function authorizeCompany(Client $client): void
    {
        abort_unless($client->company_id === auth()->user()->company_id, 404);
    }
}
