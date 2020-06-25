<?php

namespace App\View\Components\penjualan;

use Illuminate\View\Component;
use App\Penjualan\Penawaran;

class penawaranDelete extends Component
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
        return view('components.penjualan.penawaran-delete');
    }

    public function penawaran()
    {
        return Penawaran::find($this->id);
    }
}
