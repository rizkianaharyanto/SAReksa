<?php

namespace App\View\Components\stock\masterData;

use Illuminate\View\Component;

class modalEdit extends Component
{
    public $id;
    public $action;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $action)
    {
        $this->id = $id;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.stock.master-data.modal-edit');
    }
}
