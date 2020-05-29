<?php

namespace App\View\Components\pembelian;
use App\Pembelian\Pemesanan;

use Illuminate\View\Component;

class pemesananDelete extends Component
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
        return view('components.pembelian.pemesanan-delete');
    }

    public function pemesanan()
    {
        return Pemesanan::find($this->id);
    }
}
