<?php

namespace App\View\Components\pembelian;

use Illuminate\View\Component;
use App\Pembelian\Faktur;

class fakturDelete extends Component
{
    public $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.pembelian.faktur-delete');
    }

    public function faktur()
    {
        return Faktur::find($this->id);
    }
}
