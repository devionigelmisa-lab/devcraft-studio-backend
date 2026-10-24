<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DevCraftSeeder extends Seeder
{
    public function run(): void
    {
        
        Schema::disableForeignKeyConstraints();
        
        DB::table('desains')->truncate();
        DB::table('kategoris')->truncate();
        
        Schema::enableForeignKeyConstraints();

        $katPoster = DB::table('kategoris')->insertGetId(['nama_kategori' => 'Poster', 'created_at' => now(), 'updated_at' => now()]);
        $katSocial = DB::table('kategoris')->insertGetId(['nama_kategori' => 'Social Media', 'created_at' => now(), 'updated_at' => now()]);
        $katIllust = DB::table('kategoris')->insertGetId(['nama_kategori' => 'Illustration', 'created_at' => now(), 'updated_at' => now()]);
        $katBrand  = DB::table('kategoris')->insertGetId(['nama_kategori' => 'Branding', 'created_at' => now(), 'updated_at' => now()]);

        DB::table('desains')->insert([
            [
                'kategori_id' => $katSocial,
                'judul'       => 'Instagram Template Pack',
                'deskripsi'   => 'Paket template Instagram profesional untuk promosi.',
                'harga'       => 25000,
                'gambar'      => '/images/canva.png',
                'slug'        => Str::slug('Instagram Template Pack'),
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'kategori_id' => $katPoster,
                'judul'       => 'Minimalist CV Template',
                'deskripsi'   => 'Template CV ATS friendly dan profesional.',
                'harga'       => 15000,
                'gambar'      => '/images/cv.png',
                'slug'        => Str::slug('Minimalist CV Template'),
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'kategori_id' => $katPoster,
                'judul'       => 'Presentation Template Professional',
                'deskripsi'   => 'Template slide presentasi elegan untuk seminar.',
                'harga'       => 30000,
                'gambar'      => '/images/figma.png',
                'slug'        => Str::slug('Presentation Template Professional'),
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'kategori_id' => $katPoster,
                'judul'       => 'Aesthetic Academic Poster Template',
                'deskripsi'   => 'Template poster ilmiah untuk tugas kuliah.',
                'harga'       => 20000,
                'gambar'      => '/images/psd.png',
                'slug'        => Str::slug('Aesthetic Academic Poster Template'),
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'kategori_id' => $katSocial,
                'judul'       => 'Social Media Kit UMKM',
                'deskripsi'   => 'Katalog promosi dan feed kuliner untuk usaha.',
                'harga'       => 45000,
                'gambar'      => '/images/sosmed.png',
                'slug'        => Str::slug('Social Media Kit UMKM'),
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'kategori_id' => $katIllust,
                'judul'       => 'Digital Student Planner 2026',
                'deskripsi'   => 'Planner rencana perkuliahan lengkap.',
                'harga'       => 18000,
                'gambar'      => '/images/pdf.png',
                'slug'        => Str::slug('Digital Student Planner 2026'),
                'created_at'  => now(),
                'updated_at'  => now()
            ]
        ]);
    }
}