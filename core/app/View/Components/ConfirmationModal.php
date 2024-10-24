<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ConfirmationModal extends Component
{
    public $btnClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($btnClass = null)
    {
        $this->btnClass = $btnClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.confirmation-modal');
    }
}
