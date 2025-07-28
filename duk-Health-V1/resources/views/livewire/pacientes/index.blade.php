<?php

use Livewire\Volt\Component;
use App\Models\Paciente;

new class extends Component {
    public $search;
    protected $listeners = ['disable'];

    public function with(): array
    {
        return [
            'pacientes' => Paciente::buscar($this->search)->where('estado', 'Activo')->orderBy('id', 'desc')->paginate(7),
        ];
    }

    public function disable($pacienteId)
    {
        Paciente::where('id', $pacienteId)->update(['estado' => 'Inactivo']);

        return redirect()->route('pacientes.index')->with('success', 'pacientes desactivado');
    }
}; ?>

<div class="px-4 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h1 class="text-2xl text-center font-semibold text-gray-900 dark:text-white">
            {{ __('Lista de Pacientes Registrados.') }}
        </h1>
        <br>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
        <div>
            <a href="{{ route('pacientes.create') }}"
                class="inline-block px-3 py-1.5 bg-green-900 text-white rounded-md hover:bg-green-600 transition">
                <i class="fas fa-plus"></i> {{ __('Nuevo Paciente') }}
            </a>
        </div>

        <div class="w-full max-w-md mx-auto">
            <input wire:model.live="search"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-zinc-800 dark:text-white"
                placeholder="Búsqueda por nombre o email" />
            <div wire:loading>
                <span>Buscando Paciente ......</span>
            </div>
        </div>
    </div>

    @if ($pacientes->count() == 0)
        <div class="mt-4">
            <h5>{{ $search }}!</h5>
            <p>No se encontraron registros con los criterios de búsqueda ingresados.</p>
        </div>
    @else
        <div class="w-full mt-4 overflow-x-auto">

            <x-table :columns="['Nombre', 'Documento', 'Correo', 'Teléfono']" />

            <div class="mt-4">
                {{ $pacientes->links() }}
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Livewire !== 'undefined') {
                Livewire.on('confirmespecialista', function(pacienteId) {
                    Swal.fire({
                        title: "¿Estás seguro que deseas desactivar al Paciente?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Sí",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.dispatch('disable', {
                                pacienteId: pacienteId
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
