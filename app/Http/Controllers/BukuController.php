<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function create()
    {
        $kategoris = KategoriBuku::get();

        return view('pages.admin.createBuku', compact('kategoris'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        KategoriBuku::create([
            'nama' => $request->nama,
        ]);

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'cover' => 'nullable|mimes:png,jpg,jpeg,webp',
            'penulis' => 'nullable',
            'penerbit' => 'nullable',
            'tahunTerbit' => 'nullable',
            'kategori_bukus_id' => 'required',
        ]);

        $cover = $request->file('cover');

        if ($cover) {
            $cover->storeAs('public/cover', $cover->hashName());
            $coverPath = $cover->hashName();
        } else {
            $coverPath = null;
        }

        Buku::create([
            'judul' => $request->judul,
            'cover' => $coverPath,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahunTerbit' => $request->tahunTerbit,
            'kategori_bukus_id' => $request->kategori_bukus_id
        ]);

        return redirect()->route('dashboard');
    }

    public function show($id)
    {
        $buku = Buku::find($id);

        return view('pages.admin.showBuku', compact('buku'));
    }
}
