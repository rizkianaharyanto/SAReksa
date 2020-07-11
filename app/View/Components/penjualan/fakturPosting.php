<?php

namespace App\View\Components\penjualan;

use Illuminate\View\Component;
use App\Penjualan\Faktur;

class fakturPosting extends Component
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
        return view('components.penjualan.faktur-posting');
    }

    public function faktur()
    {
        return Faktur::find($this->id);
    }
}
