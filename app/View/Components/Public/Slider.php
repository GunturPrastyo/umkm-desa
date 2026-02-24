<?php

namespace App\View\Components\Public;

use Illuminate\View\Component;
use App\Models\Slider as SliderModel;
use App\Models\Umkm;

class Slider extends Component
{
    public $sliders;
    public $totalUmkm;

    public function __construct()
    {
        $this->sliders = SliderModel::all();
        $this->totalUmkm = Umkm::count(); // hitung jumlah UMKM
    }

    public function render()
    {
        return view('components.public.slider', [
            'sliders'   => $this->sliders,
            'totalUmkm' => $this->totalUmkm,
        ]);
    }
}
