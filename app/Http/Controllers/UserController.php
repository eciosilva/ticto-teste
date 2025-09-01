<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Http as HttpClient;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * List all users
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::where('position', 'Empregado')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show a single user
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a new user
     *
     * @return \Illuminate\View\View
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        // Recupera o endereço através da API externa
        $endereco = HttpClient::get(sprintf('https://viacep.com.br/ws/%s/json/', $validated['cep']));

        $validated['position'] = 'Empregado';
        $validated['manager_id'] = auth()->user()->id;
        
        $validated['birth_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['birth_date'])->format('Y-m-d');
        $validated['address'] = $endereco->json()['logradouro'] ?? '';

        $user = User::create($validated);

        return redirect()->route('users.index')->with('success', 'Funcionário criado com sucesso.');
    }

    /**
     * Show the form for editing a new user.
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $user->birth_date = \Carbon\Carbon::createFromFormat('Y-m-d', $user->birth_date)->format('d/m/Y');
        return view('users.edit', compact('user'));
    }

    /**
     * Update an existing user
     *
     * @return \Illuminate\View\View
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();
        $validated['birth_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['birth_date'])->format('Y-m-d');
        if (null === $validated['password']) {
            unset($validated['password']);
        }
        
        // Recupera o endereço através da API externa
        $endereco = HttpClient::get(sprintf('https://viacep.com.br/ws/%s/json/', $validated['cep']));
        $validated['address'] = $endereco->json()['logradouro'] ?? '';
        
        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Funcionário atualizado com sucesso.');
    }

    /**
     * Delete a user
     *
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('success', 'Funcionário excluído com sucesso!');

        return response()->json(['message' => 'Funcionário excluído com sucesso!']);
    }
}