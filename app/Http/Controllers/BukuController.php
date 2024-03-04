<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function like($id)
    {
        $buku = Buku::with('user')->findOrFail($id);
        $attr = ['user_id' => Auth::user()->id];

        if ($buku->likes()->where($attr)->exists()) {
            $buku->likes()->where($attr)->delete();
            $msg = ['status' => 'UNLIKE'];
        } else {
            $buku->likes()->create($attr);
            $msg = ['status' => 'LIKE'];
        }

        return response()->json($msg);
    }

    public function likedBuku(Request $request)
    {
        $user = $request->user();
        $bukus = $user->likes()->latest()->get();

        return view('pages.user.likedBuku', compact('bukus'));
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
            'stok' => 'required',
            'sinopsis' => 'required',
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
            'kategori_bukus_id' => $request->kategori_bukus_id,
            'stok' => $request->stok,
            'sinopsis' => $request->sinopsis,
        ]);

        return redirect()->route('dashboard');
    }

    public function show($id)
    {
        $buku = Buku::find($id);
        $bukusPenulis = Buku::where('penulis', $buku->penulis)->where('id', '!=', $buku->id)->get();
        $bukusPenerbit = Buku::where('penerbit', $buku->penerbit)->where('id', '!=', $buku->id)->get();
        $bukusKategori = Buku::where('kategori_bukus_id', $buku->kategori_bukus_id)->where('id', '!=', $buku->id)->get();

        return view('pages.admin.showBuku', compact('buku', 'bukusPenulis', 'bukusPenerbit', 'bukusKategori'));
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
            'stok' => 'required',
            'sinopsis' => 'required',
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
                'stok' => $request->stok,
                'sinopsis' => $request->sinopsis,
            ]);
        } else {
            $buku->update([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahunTerbit' => $request->tahunTerbit,
                'kategori_bukus_id' => $request->kategori_bukus_id,
                'stok' => $request->stok,
                'sinopsis' => $request->sinopsis,
            ]);
        }

        return redirect()->route('dashboard');
    }
}
