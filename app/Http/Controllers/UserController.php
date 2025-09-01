<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
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
     * Show the form for creating a new post.
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
     * Update an existing user
     *
     * @return \Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return response()->json($user);
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