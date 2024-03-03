<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function edit($id)
    {
        $buku = Buku::find($id);
        $kategoris = KategoriBuku::get();

        return view('pages.admin.editBuku', compact('buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'cover' => 'mimes:png,jpg,jpeg,webp',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahunTerbit' => 'required',
            'kategori_bukus_id' => 'required',
        ]);

        $buku = Buku::find($id);

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $cover->storeAs('public/cover', $cover->hashName());

            Storage::delete('public/cover/ ' . $buku->cover);

            $buku->update([
                'judul' => $request->judul,
                'cover' => $cover->hashName(),
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahunTerbit' => $request->tahunTerbit,
                'kategori_bukus_id' => $request->kategori_bukus_id,
            ]);
        } else {
            $buku->update([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahunTerbit' => $request->tahunTerbit,
                'kategori_bukus_id' => $request->kategori_bukus_id,
            ]);
        }

        return redirect()->route('dashboard');
    }
}
