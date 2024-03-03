<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $bukus = Buku::latest()->get();
        $kategoris = KategoriBuku::get();

        return view('dashboard', compact('bukus', 'kategoris'));
    }
}
