<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('desains', function (Blueprint $table) {
            $table->id('desain_id');
            // Menghubungkan ke tabel 'kategoris' pada kolom 'kategori_id'
            $table->foreignId('kategori_id')->constrained('kategoris', 'kategori_id')->onDelete('cascade');
            $table->string('judul', 150);
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 12, 2);
            $table->string('gambar')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('desains');
    }
};