<?php

namespace App\View\Components\Public;

use Illuminate\View\Component;
use App\Models\Sosmed; // model sosmed di DB

class Navbar extends Component
{
    public $sosmed;

    public function __construct()
    {
        // Ambil data sosial media dari database
        $this->sosmed = Sosmed::first();
    }

    public function render()
    {
        return view('components.public.navbar');
    }
}
