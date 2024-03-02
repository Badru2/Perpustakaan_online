<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $bukus = Buku::latest()->get();

        return view('dashboard', compact('bukus'));
    }
}
