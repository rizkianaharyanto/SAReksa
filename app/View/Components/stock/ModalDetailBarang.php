<?php

namespace App\View\Components\stock;

use Illuminate\View\Component;

class ModalDetailBarang extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $barang;
    public function __construct($barang)
    {
        $this->barang = $barang;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.stock.modal-detail-barang');
    }
}
