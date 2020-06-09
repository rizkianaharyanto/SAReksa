<?php

namespace App\View\Components\pembelian;

use App\Pembelian\Pembayaran;
use Illuminate\View\Component;

class pembayaranDelete extends Component
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
        return view('components.pembelian.pembayaran-delete');
    }

    public function pembayaran()
    {
        return Pembayaran::find($this->id);
    }
}
