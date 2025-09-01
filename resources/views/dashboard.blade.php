<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    {{ __("Seja bem-vindo ao sistema de Ponto Eletrônico da TICTO!") }}
                </div>

                @if (session()->has('success'))
                    <div class="alert alert-success mx-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger mx-3">
                        {{ session('error') }}
                    </div>
                @endif

                @if (!auth()->user()->isAdmin())
                    <div class="mt-4 mb-4 text-center">
                        <a href="{{ route('users.register_clock_in') }}" class="btn btn-lg btn-primary">
                            {{ __('Registrar Ponto') }}
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
