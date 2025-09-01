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

                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <a class="btn btn-primary float-end mb-4" href="{{ route('users.create') }}">Novo Funcionário</a>
                                <h3 class="text-lg font-bold mb-4">Lista de Funcionários</h3>
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">CPF</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Endereço</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                                <td class="_cpf px-6 py-4 whitespace-nowrap">{{ $user->cpf }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="_cep">{{ $user->cep }}</span> - {{ $user->address }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <a href="{{ route('users.edit', $user->id) }}" 
                                                        class="text-blue-600 hover:text-blue-900"
                                                        ><i class="bi bi-pencil-square"></i></a>
                                                    <a href="javascript:void(0);" onclick="deleteUser({{ $user->id }})"
                                                        class="text-red-600 hover:text-red-900 ml-4"
                                                        ><i class="bi bi-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                $('._cpf').mask('000.000.000-00');
                $('._cep').mask('00000-000');
            });

            function deleteUser(id) {
                if (confirm('Tem certeza que deseja excluir este funcionário?')) {
                    $.ajax({
                        url: `/users/${id}`,
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        type: 'POST',
                        success: function() {
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            alert('Erro ao excluir usuário.');
                        }
                    });
                }
            };
        </script>
    </x-slot>
</x-app-layout>