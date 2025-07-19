<?php

use Livewire\Volt\Component;
use App\Models\Especialista;

new class extends Component {
    public $search;
       protected $listeners = ['disable'];

    public function with(): array
    {
        return [
            'especialistas' => Especialista::buscar($this->search)->where('estado', 'Activo')->orderBy('id', 'desc')->paginate(7),
        ];
    }

    public function disable($especialistaId)
    {
        Especialista::where('id', $especialistaId)->update(['estado' => 'Inactivo']);

        return redirect()->route('especialistas.index')->with('success', 'Especialistas desactivado');
    }
}; ?>


<div class="px-4 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h1 class="text-2xl text-center font-semibold text-gray-900 dark:text-white">
            {{ __('Lista de Especialistas Registrados.') }}
        </h1>
        <br>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
        <div>
            <a href="{{ route('especialistas.create') }}"
                class="inline-block px-3 py-1.5 bg-green-900 text-white rounded-md hover:bg-green-600 transition">
                <i class="fas fa-plus"></i> {{ __('Nuevo Especialista') }}
            </a>
        </div>

        <div class="w-full max-w-md mx-auto">
            <input wire:model.live="search"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-zinc-800 dark:text-white"
                placeholder="Búsqueda por nombre o email" />
            <div wire:loading>
                <span>Buscando Especialista ......</span>
            </div>
        </div>
    </div>

    @if ($especialistas->count() == 0)
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
                        <th class="px-6 py-3 text-left">Nombres & Apellidos</th>
                        <th class="px-6 py-3 text-left">Tipo & Numero Documento</th>
                        <th class="px-6 py-3 text-left">Genero</th>
                        {{-- <th class="px-6 py-3 text-left">Fecha de Nacimiento</th> --}}
                        {{-- <th class="px-6 py-3 text-left">Fotografía</th> --}}
                        {{-- <th class="px-6 py-3 text-left">Dirección de Residencia</th> --}}
                        <th class="px-6 py-3 text-left">Telefono Contacto</th>
                        <th class="px-6 py-3 text-left">Telefono Contacto 2</th>
                        <th class="px-6 py-3 text-left">Correo Electronico</th>
                        <th class="px-6 py-3 text-left">Especialidad médica</th>
                        {{-- <th class="px-6 py-3 text-left">Registro Médico</th> --}}
                        <th class="px-6 py-3 text-left">Fecha Inicio labor</th>
                        {{-- <th class="px-6 py-3 text-left">Experiencia Laboral</th> --}}
                        {{-- <th class="px-6 py-3 text-left">Certificaciones </th> --}}
                        <th class="px-6 py-3 text-left">Estado </th>
                        <th class="px-6 py-3 text-center">Acciones</th>
                    </tr>
                </x-slot>

                @foreach ($especialistas as $especialista)
                    <tr class="hover:bg-zinc-100 dark:hover:bg-zinc-800 transition">
                        {{-- <td class="px-6 py-3">{{ $especialista->id }}</td> --}}
                        <td class="px-6 py-3 text-left">{{ $especialista->nombres . ' ' . $especialista->apellidos }}</td>
                        <td class="px-6 py-3 text-left">{{ $especialista->tipo_identificacion . ' # ' . $especialista->numero_identificacion }}</td>
                        <td class="px-6 py-3 text-left">{{ $especialista->genero }}</td>
                        {{-- <td>{{ $especialista->fecha_de_nacimiento }}</td>
                        <td>{{ Str::limit($especialista->path_fotografia, 20) }}</td>
                        <td>{{ Str::limit($especialista->direccion_residencia, 20) }}</td> --}}
                        <td class="px-6 py-3 text-left">{{ $especialista->telefono_contacto1 }}</td>
                        <td class="px-6 py-3 text-left">{{ $especialista->telefono_contacto2 }}</td>
                        <td class="px-6 py-3 text-left">{{ $especialista->email }}</td>
                        <td class="px-6 py-3 text-left">{{ $especialista->especialidad_medica }}</td>
                        {{-- <td>{{ $especialista->registro_medico }}</td> --}}
                        <td class="px-6 py-3 text-left">{{ $especialista->fecha_inicio_labor }}</td>
                        {{-- <td>{{ Str::limit($especialista->experiencia, 20) }}</td> --}}
                        {{-- <td>{{ Str::limit($especialista->certificaciones, 20) }}</td> --}}
                        <td class="px-6 py-3 text-left">
                            <button wire:click="$dispatch('confirmespecialista', {{ $especialista->id }})"
                                class="cursor-pointer inline-block px-3 py-1.5 bg-green-900 text-white rounded-md hover:bg-red-600 transition"
                                title="Desactivar">
                                {{ $especialista->estado }}
                            </button>
                        </td>
                        <td class="px-6 py-3 text-center">
                            <a href="{{ route('especialistas.edit', $especialista->id) }}"
                                class="inline-block px-3 py-1.5 bg-amber-600 text-white rounded-md hover:bg-amber-900 transition">
                                Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-table>

            <div class="mt-4">
                {{ $especialistas->links() }}
            </div>
        </div>
    @endif

    <div class="mt-4">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Livewire !== 'undefined') {
                    Livewire.on('confirmespecialista', function(especialistaId) {
                        Swal.fire({
                            title: "¿Estás seguro que deseas desactivar al Especialista?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Sí",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Livewire.dispatch('disable', {
                                    especialistaId: especialistaId
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
