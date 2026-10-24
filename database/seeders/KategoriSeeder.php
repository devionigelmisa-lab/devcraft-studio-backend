<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
        ['nama_kategori' => 'UI/UX Kit', 'created_at' => now(), 'updated_at' => now()],
        ['nama_kategori' => 'Logo & Mascot', 'created_at' => now(), 'updated_at' => now()],
        ['nama_kategori' => 'Banner & Infografis', 'created_at' => now(), 'updated_at' => now()],
    ]);
    }
}
