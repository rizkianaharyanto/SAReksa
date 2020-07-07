<?php

namespace App\View\Components\stock;

use Illuminate\View\Component;

class StepperBarang extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $kategoriBarang;
    public $satuanUnit;
    public $gudangs;

    public function __construct($kategoriBarang, $satuanUnit, $gudangs)
    {
        $this->kategoriBarang = $kategoriBarang;
        $this->satuanUnit = $satuanUnit;
        $this->gudangs = $gudangs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.stock.stepper-barang');
    }
}
