<?php

use Livewire\Volt\Component;
use App\Models\User;

new class extends Component {
    public $search;

    protected $listeners = ['disable'];

    public function with(): array
    {
        return [
            'users' => User::buscar($this->search)->where('estado', 'Activo')->orderBy('id', 'desc')->paginate(7),
        ];
    }

    public function disable($userId)
    {
        $validator = Validator::make(
            ['id' => $userId],
            [
                'id' => 'required|integer|exists:users,id',
            ],
        );

        if ($validator->fails()) {
            session()->flash('danger', 'ID inválido o no existente');
            return;
        }

        User::where('id', $userId)->update(['estado' => 'Inactivo']);

        return redirect()->route('usuarios.index')->with('success', 'Usuario desactivado');
    }
};
?>

<div class="px-4 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h1 class="text-2xl text-center font-semibold text-gray-900 dark:text-white">
            {{ __('Lista de Usuarios Registrados.') }}
        </h1>
        <br>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
        <div>
            <a href="{{ route('usuarios.create') }}"
                class="inline-block px-3 py-1.5 bg-green-900 text-white rounded-md hover:bg-green-600 transition">
                <i class="fas fa-plus"></i> {{ __('Nuevo Usuario') }}
            </a>
        </div>

        <div class="w-full max-w-md mx-auto">
            <input wire:model.live="search"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-zinc-800 dark:text-white"
                placeholder="Búsqueda por nombre o email" />
            <div wire:loading>
                <span>Buscando Usuario ......</span>
            </div>
        </div>
    </div>

    @if ($users->count() == 0)
        <div class="mt-4">
            <h5>{{ $search }}!</h5>
            <p>No se encontraron registros con los criterios de búsqueda ingresados.</p>
        </div>
    @else
        <div class="w-full mt-4 overflow-x-auto">
            <x-table>
                <x-slot name="thead">
                    <tr>
                        {{-- <th class="px-6 py-3 text-left">ID</th> --}}
                        <th class="px-6 py-3 text-left">Nombre</th>
                        <th class="px-6 py-3 text-left">Correo</th>
                        <th class="px-6 py-3 text-left">Contacto</th>
                        <th class="px-6 py-3 text-left">Cargo</th>
                        <th class="px-6 py-3 text-left">Rol</th>
                        <th class="px-6 py-3 text-left">Estado</th>
                        <th class="px-6 py-3 text-center">Acciones</th>
                    </tr>
                </x-slot>

                @foreach ($users as $user)
                    <tr class="hover:bg-zinc-100 dark:hover:bg-zinc-800 transition">
                        {{-- <td class="px-6 py-3">{{ $user->id }}</td> --}}
                        <td class="px-6 py-3 font-medium">{{ $user->nombres }} {{ $user->apellidos }}</td>
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
                        <td class="px-6 py-3 text-left">
                            <button wire:click="$dispatch('confirmUser', {{ $user->id }})"
                                class="cursor-pointer inline-block px-3 py-1.5 bg-green-900 text-white rounded-md hover:bg-red-600 transition"
                                title="Desactivar">
                                {{ $user->estado }}
                            </button>
                        </td>

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
        </div>
    @endif

    <div class="mt-4">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Livewire !== 'undefined') {
                    Livewire.on('confirmUser', function(userId) {
                        Swal.fire({
                            title: "¿Estás seguro que deseas desactivar al usuario?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Sí",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Livewire.dispatch('disable', {
                                    userId: userId
                                });
                            }
                        });
                    });
                } else {
                    console.warn('Livewire no está definido aún. Script de confirmación omitido.');
                }
            });
        </script>

    </div>
</div>
