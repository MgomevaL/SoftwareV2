<?php

use Livewire\Volt\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

new class extends Component {
    public $user;
    public $roles;
    public $selectedRoles = [];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->selectedRoles = $this->user->roles->pluck('id')->toArray();
    }

    public function updateRoles()
    {
        $this->user->roles()->detach(); // Elimina todos los roles del usuario (para evitar duplicados
        $this->user->roles()->attach($this->selectedRoles);

        return redirect()->route('usuarios.index')->with('success', 'Los roles se actualizaron con éxito');
    }

    public function render(): mixed
    {
        $this->roles = Role::all();
        return view('livewire.usuarios.edit', ['user' => $this->user]);
    }
}; ?>

<div>
    <x-card>
        {{-- Título centrado con mejor estilo --}}
        <x-slot:titleCard>
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-zinc-800 dark:text-white">
                    Asignar Roles al Usuario:
                    <span class="font-medium text-blue-600 dark:text-blue-400">{{ $user->name }}</span>
                </h2>
                <hr class="my-4 border-gray-200 dark:border-zinc-700">
            </div>
        </x-slot:titleCard>

        {{-- Cuerpo del card --}}
        <x-slot:bodyCard>
            <form wire:submit.prevent="updateRoles" class="space-y-4">
                <h4 class="text-lg font-semibold text-zinc-700 dark:text-zinc-200">Lista de Roles</h4>
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($roles as $role)
                        <label
                            class="flex items-center space-x-2 p-2 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-700 transition">
                            <input wire:model="selectedRoles" type="checkbox" value="{{ $role->id }}"
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:bg-zinc-800 dark:border-zinc-600">
                            <span class="text-zinc-800 dark:text-zinc-100">
                                {{ $role->name }}
                                @if (in_array($role->id, $selectedRoles))
                                    <span class="text-sm text-gray-500 dark:text-gray-400">(Actual)</span>
                                @endif
                            </span>
                        </label>
                    @endforeach
                </div>
                <hr class="my-4 border-gray-200 dark:border-zinc-700">
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <x-button type="submit">
                            Guardar cambios
                        </x-button>
                    </div>
                    <div></div>
                    <div>
                        <x-button variant="success" href="{{ route('usuarios.index') }}">
                            Regresar
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot:bodyCard>
    </x-card>
</div>
