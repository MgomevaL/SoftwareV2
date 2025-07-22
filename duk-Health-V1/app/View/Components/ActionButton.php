<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    public string $label;
    public string $type;
    public string $color;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $label = 'Crear',
        string $type = 'submit',
        string $color = 'green'

    ) {
        $this->label = $label;
        $this->type = $type;
        $this->color = $color;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-button');
    }
}
