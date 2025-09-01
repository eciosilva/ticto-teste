<?php

namespace App\Http\Requests;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->position === User::POSITION_ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'cpf' => 'required|string|min:11|max:11|unique:users,cpf',
            'cep' => 'required|string|min:8|max:8',
            'birth_date' => 'required|date_format:d/m/Y',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('cpf')) {
            // Remove os caracteres das máscaras
            $transformedCpf = preg_replace('/\D/', '', $this->cpf);
            $this->merge([
                'cpf' => $transformedCpf,
            ]);
        }
        
        if ($this->has('cep')) {
            // Remove os caracteres das máscaras
            $transformedCep = preg_replace('/\D/', '', $this->cep);
            $this->merge([
                'cep' => $transformedCep,
            ]);
        }
    }

    protected function passedValidation(): void
    {
        $password = bcrypt($this->password); // Aplica o hash na senha
        // Transforma 'd/m/Y' para 'Y-m-d' - padrão ISO para salvar no SGBD
        $transformedDate = Carbon::createFromFormat('d/m/Y', $this->birth_date)->format('Y-m-d');

        $this->merge([
            'birth_date' => $transformedDate,
            'password' => $password
        ]);
    }
}
