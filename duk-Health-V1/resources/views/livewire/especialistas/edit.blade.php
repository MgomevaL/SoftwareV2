<?php

use Livewire\Volt\Component;
use App\Models\Especialista;

new class extends Component {

    public $especialista;
    public $nombres, $apellidos, $tipo_identificacion, $numero_identificacion, $genero,
        $fecha_de_nacimiento, $direccion_residencia, $telefono_contacto1, $telefono_contacto2,
        $email, $especialidad_medica, $registro_medico, $fecha_inicio_labor, $experiencia,
        $certificaciones, $estado;

    public function mount(Especialista $especialista)
    {
        $this->especialista = $especialista;
        $this->nombres = $especialista->nombres;
        $this->apellidos = $especialista->apellidos;
        $this->tipo_identificacion = $especialista->tipo_identificacion;
        $this->numero_identificacion = $especialista->numero_identificacion;
        $this->genero = $especialista->genero;
        $this->fecha_de_nacimiento = $especialista->fecha_de_nacimiento;
        $this->direccion_residencia = $especialista->direccion_residencia;
        $this->telefono_contacto1 = $especialista->telefono_contacto1;
        $this->telefono_contacto2 = $especialista->telefono_contacto2;
        $this->email = $especialista->email;
        $this->especialidad_medica = $especialista->especialidad_medica;
        $this->registro_medico = $especialista->registro_medico;
        $this->fecha_inicio_labor = $especialista->fecha_inicio_labor;
        $this->experiencia = $especialista->experiencia;
        $this->certificaciones = $especialista->certificaciones;
        $this->estado = $especialista->estado;
    }

    public function actualizarEspecialista()
    {
        $this->especialista->update([
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'tipo_identificacion' => $this->tipo_identificacion,
            'numero_identificacion' => $this->numero_identificacion,
            'genero' => $this->genero,
            'fecha_de_nacimiento' => $this->fecha_de_nacimiento,
            'direccion_residencia' => $this->direccion_residencia,
            'telefono_contacto1' => $this->telefono_contacto1,
            'telefono_contacto2' => $this->telefono_contacto2,
            'email' => $this->email,
            'especialidad_medica' => $this->especialidad_medica,
            'registro_medico' => $this->registro_medico,
            'fecha_inicio_labor' => $this->fecha_inicio_labor,
            'experiencia' => $this->experiencia,
            'certificaciones' => $this->certificaciones,
            'estado' => $this->estado,
        ]);

        return redirect()->route('especialistas.index')->with('success', 'Especialista actualizado correctamente.');
    }

}; ?>

<div class="w-full mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-lg space-y-6">
    <h2 class="text-2xl font-bold text-center text-zinc-800 dark:text-white">Editar Especialista</h2>
    <hr class="border-gray-300 dark:border-zinc-700">

    <form wire:submit.prevent="actualizarEspecialista">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <x-input-field name="nombres" label="Nombres" model="nombres" />
            <x-input-field name="apellidos" label="Apellidos" model="apellidos" />
            <x-input-field name="tipo_identificacion" label="Tipo de Identificación" model="tipo_identificacion" />
            <x-input-field name="numero_identificacion" label="Número de Identificación"
                model="numero_identificacion" />
            <x-input-field name="genero" label="Género" model="genero" />
            <x-input-field name="fecha_de_nacimiento" label="Fecha de Nacimiento" type="date"
                model="fecha_de_nacimiento" />
            <x-input-field name="direccion_residencia" label="Dirección" model="direccion_residencia" />
            <x-input-field name="telefono_contacto1" label="Teléfono 1" model="telefono_contacto1" />
            <x-input-field name="telefono_contacto2" label="Teléfono 2" model="telefono_contacto2" />
            <x-input-field name="email" label="Email" type="email" model="email" />
            <x-input-field name="especialidad_medica" label="Especialidad Médica" model="especialidad_medica" />
            <x-input-field name="registro_medico" label="Registro Médico" model="registro_medico" />
            <x-input-field name="fecha_inicio_labor" label="Fecha de Inicio" type="date"
                model="fecha_inicio_labor" />
            <x-input-field name="experiencia" label="Experiencia" model="experiencia" />
            <x-input-field name="certificaciones" label="Certificaciones" model="certificaciones" />
            <x-input-field name="estado" label="Estado" model="estado" readonly />
        </div>

        <div class="mt-6 flex justify-between">
            <x-button type="submit" variant="primary">Actualizar Especialista</x-button>
            <x-button href="{{ route('especialistas.index') }}" variant="secondary">Regresar</x-button>
        </div>
    </form>
</div>
