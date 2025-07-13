<?php

use Livewire\Volt\Component;
use App\Models\User;

new class extends Component {
    public $nombres, $apellidos, $telefono, $cargo, $email, $password, $password_confirmation;

    public function rules(): array
    {
        return [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:15|unique:users,telefono',
            'cargo' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ];
    }

    public function createUser()
    {
        $this->validate();

        User::create([
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'telefono' => $this->telefono,
            'cargo' => $this->cargo,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        return redirect(route('usuarios.index'))->with('success', 'Usuario creado con éxito');
    }
};
?>

<div>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white text-center">
            {{ __('Formulario de Creación de Usuarios.') }}
        </h1>
        <br>
    </x-slot>
    <div class="max-w-2xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-md">
        <form wire:submit.prevent='createUser' enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <!-- Campo de Nombres con validación y mensaje de error -->
                <div class="mb-4">
                    <label for="nombres"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombres</label>
                    <input wire:model="nombres" autocomplete="given-name"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:bg-zinc-800 dark:text-white">
                    @error('nombres')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Apellidos -->
                <div class="mb-4">
                    <label for="apellidos"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Apellidos</label>
                    <input wire:model="apellidos" autocomplete="family-name"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:bg-zinc-800 dark:text-white">
                    @error('apellidos')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">

                <!-- Teléfono -->
                <div class="mb-4">
                    <label for="telefono"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
                    <input wire:model="telefono" autocomplete="tel"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:bg-zinc-800 dark:text-white">
                    @error('telefono')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cargo -->
                <div class="mb-4">
                    <label for="cargo"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cargo</label>
                    <input wire:model="cargo" autocomplete="cargo"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:bg-zinc-800 dark:text-white">
                    @error('cargo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid gap-4">

                {{-- email --}}

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo
                        Electrónico</label>
                    <input wire:model="email" autocomplete="email"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:bg-zinc-800 dark:text-white">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <!-- Contraseña -->
                <div class="mb-6">
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
                    <input wire:model="password" type="password"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:bg-zinc-800 dark:text-white">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Confirmar Contraseña -->
                <div class="mb-6">
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmar Contraseña</label>
                    <input wire:model="password_confirmation" type="password" id="password_confirmation"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:bg-zinc-800 dark:text-white">
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Botón -->
            <div class="flex justify-center">
                <button wire:loading.attr="disabled"
                    class="px-4 py-2 cursor-pointer bg-green-600 text-white rounded-md hover:bg-green-900 transition "
                    wire:loading.remove>Crear
                    Usuario</button>
                <span wire:loading>
                    {{-- Icono de carga --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </span>
            </div>
        </form>
    </div>
</div>
