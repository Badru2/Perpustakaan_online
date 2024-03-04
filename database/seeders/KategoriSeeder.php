<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriBuku::insert([
            ['nama' => 'Action'],
            ['nama' => 'Adventure'],
            ['nama' => 'Comedy'],
            ['nama' => 'Fantasy'],
            ['nama' => 'Horror'],
        ]);
    }
}
