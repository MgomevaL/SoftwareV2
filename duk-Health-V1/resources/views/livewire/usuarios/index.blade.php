<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\User;

new class extends Component {

    public $search;

    public function render(): mixed
    {
        $users = User::with('roles')
            ->where('estado', '=', 'activo')
            ->where(function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%')->orWhere('email', 'LIKE', '%' . $this->search . '%');
            })
            ->OrderBy('created_at', 'desc')
            ->paginate(5);

        return view('livewire.usuarios.index', compact('users'));
    }
}; ?>

<div class="w-full px-6">
    {{-- Titulo de pagina --}}
    <x-slot name=" title">
        {{ __('Duk Health - Usuarios') }}
    </x-slot>

    {{-- Contenido de la pagina --}}
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
            {{ __('Lista de Usuarios Registrados.') }}
        </h1><br>

        <div class="grid grid-cols-3 gap-4">
            <div><a href="{{ route('usuarios.create') }}"
                    class="inline-block px-3 py-1.5 bg-green-900 text-white rounded-md hover:bg-green-600 transition">
                    <i class="fas fa-plus"></i> {{ __('Nuevo Usuario') }}
                </a></div>
            <div></div>
            <div>
                <x-input wire:model='search'/>
            </div>
        </div>

        {{-- separador --}}
        <hr class="my-4 border-gray-200 dark:border-zinc-700">

    </x-slot>

    <x-slot name="content">
        <x-table>
            <x-slot:thead>
                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">Nombre</th>
                    <th class="px-6 py-3 text-left">Correo</th>
                    <th class="px-6 py-3 text-left">Contacto</th>
                    <th class="px-6 py-3 text-left">Cargo</th>
                    <th class="px-6 py-3 text-left">Rol</th>
                    <th class="px-6 py-3 text-left">Estado</th>
                    <th class="px-6 py-3 text-center" colspan="">Acciones</th>
                </tr>
            </x-slot:thead>

            @foreach ($users as $user)
                <tr class="hover:bg-zinc-100 dark:hover:bg-zinc-800 transition">
                    <td class="px-6 py-3">{{ $user->id }}</td>
                    <td class="px-6 py-3 font-medium">{{ $user->name }}</td>
                    <td class="px-6 py-3">{{ $user->email }}</td>
                    <td class="px-6 py-3">{{ $user->telefono }}</td>
                    <td class="px-6 py-3">{{ $user->cargo }}</td>
                    <td class="px-6 py-3">
                        @if ($user->roles->count())
                            @foreach ($user->roles as $role)
                                {{ $role->name }}
                            @endforeach
                        @else
                            <p>Sin Rol Asignado</p>
                        @endif
                    </td>
                    <td class="px-6 py-3">{{$user->estado}}</td>
                    <td class="px-6 py-3 text-center">
                        <a href="{{ route('usuarios.edit', $user->id) }}"
                            class="inline-block px-3 py-1.5 bg-amber-600 text-white rounded-md hover:bg-amber-900 transition">
                            Editar
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-table>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </x-slot>
</div>
