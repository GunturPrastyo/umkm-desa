<?php

namespace App\Http\Controllers\Public;

use App\Models\Umkm;
use App\Models\Sosmed;
use Illuminate\Http\Request;
use App\Models\Galeri\Galeri;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Umkm::with('photos');

        // Filter kategori (kecuali 'semua')
        if ($request->kategori && $request->kategori !== 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // Filter pencarian
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->search . '%')
                    ->orWhere('nama_pemilik', 'like', '%' . $request->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        // Paginasi (misal 9 per halaman)
        $umkms = $query->paginate(6);
        $galeri = Galeri::latest()->take(4)->get()->pluck('foto');

        // Supaya pagination tetap bawa parameter search & kategori
        $umkms->appends([
            'kategori' => $request->kategori,
            'search'   => $request->search,
        ]);

        $sosmed = Sosmed::all();
        // Mapping foto galeri dengan path storage
        $fotoGaleri = $galeri->map(fn($foto) => asset('storage/' . $foto));
        $totalUmkm = Umkm::count();

        return view('public.home', compact('umkms', 'fotoGaleri', 'totalUmkm', 'sosmed'));
    }
}
