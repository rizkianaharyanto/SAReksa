<?php

namespace App\View\Components\pembelian;

use Illuminate\View\Component;
use App\Pembelian\Permintaan;

class permintaanDelete extends Component
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
        return view('components.pembelian.permintaan-delete');
    }

    public function permintaan()
    {
        return Permintaan::find($this->id);
    }
}
