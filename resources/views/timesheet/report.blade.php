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
                                <a class="btn btn-secondary float-end mb-4" href="{{ route('users.index') }}">Voltar</a>
                                <h3 class="text-lg font-bold mb-4">Folha de Ponto</h3>

                                <div>
                                    <form method="GET" action="{{ route('timesheet.report') }}" class="flex items-center space-x-4 mb-4">
                                        <label for="start_date" class="mr-2">Início:</label>
                                        <input type="date" id="start_date" name="start_date" class="border rounded p-1" value="{{ request('start_date', now()->format('Y-m-d')) }}">

                                        <label for="end_date" class="ml-4 mr-2">Fim:</label>
                                        <input type="date" id="end_date" name="end_date" class="border rounded p-1" value="{{ request('end_date', now()->format('Y-m-d')) }}">

                                        <button type="submit" class="ml-4 btn btn-primary">Buscar</button>
                                    </form>
                                </div>

                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Funcionário</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cargo</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Idade</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gestor</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entrada</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Saída</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($timesheet as $entry)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $entry->id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $entry->employee_name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $entry->position }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $entry->age }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $entry->manager_name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $entry->work_date }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $entry->start_time }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $entry->end_time }}</td>
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
</x-app-layout>