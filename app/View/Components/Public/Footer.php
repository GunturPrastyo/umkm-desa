<?php

namespace App\View\Components\Public;

use Closure;
use Illuminate\View\Component;
use App\Models\Sosmed;

class Footer extends Component
{
    public $sosmed;

    public function __construct()
    {
        // Ambil data sosmed pertama (atau sesuaikan kalau banyak data)
        $this->sosmed = Sosmed::first();
    }

    public function render(): \Illuminate\View\View|Closure|string
    {
        return view('components.public.footer');
    }
}
