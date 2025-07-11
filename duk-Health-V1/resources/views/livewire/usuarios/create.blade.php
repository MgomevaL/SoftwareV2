<?php

use Livewire\Volt\Component;

new class extends Component {}; ?>

<div>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white text-center">
            {{ __('Formulario de Creación de Usuarios.') }}
        </h1>
        <br>
    </x-slot>
    <div class="max-w-2xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-md">
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2 gap-4">

                <!-- Campo de Nombres con validación y mensaje de error -->
                <div class="mb-4">
                    <label for="nombres"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombres</label>
                    <input type="text" name="nombres" id="nombres" required autocomplete="given-name"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:bg-zinc-800 dark:text-white">
                    @error('nombres')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Apellidos -->
                <div class="mb-4">
                    <label for="apellidos"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:bg-zinc-800 dark:text-white">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">

                <!-- Teléfono -->
                <div class="mb-4">
                    <label for="telefono"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
                    <input type="tel" name="telefono" id="telefono"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:bg-zinc-800 dark:text-white">
                </div>

                <!-- Cargo -->
                <div class="mb-4">
                    <label for="cargo"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cargo</label>
                    <input type="text" name="cargo" id="cargo"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:bg-zinc-800 dark:text-white">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">

                {{-- email --}}

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo
                        Electrónico</label>
                    <input type="email" name="email" id="email" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:bg-zinc-800 dark:text-white">
                </div>

                <!-- Contraseña -->
                <div class="mb-6">
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring focus:ring-blue-500 dark:bg-zinc-800 dark:text-white">
                </div>
            </div>

            <!-- Botón -->
            <div class="flex justify-center">
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-900 transition">Crear
                    Usuario</button>
            </div>
        </form>
    </div>
</div>
