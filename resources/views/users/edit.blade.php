<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Funcionários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <h3 class="text-lg font-bold mb-4">Editar Funcionário</h3>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('users.update', $user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                                        <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('name', $user->name) }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('email', $user->email) }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                                        <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Deixe em branco para manter a senha atual">
                                    </div>
                                    <div class="mb-4">
                                        <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                                        <input type="text" name="cpf" id="cpf" required class="_cpf mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('cpf', $user->cpf) }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                                        <input type="text" name="cep" id="cep" required class="_cep mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('cep', $user->cep) }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                                        <input type="text" name="birth_date" id="birth_date" required class="_date mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('birth_date', $user->birth_date) }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <a class="btn btn-secondary" href="{{ route('users.index') }}">Cancelar</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                $('._cep').mask('00000-000');
                $('._cpf').mask('000.000.000-00');
                $('._date').mask('00/00/0000');
            });
        </script>
    </x-slot>
</x-app-layout>