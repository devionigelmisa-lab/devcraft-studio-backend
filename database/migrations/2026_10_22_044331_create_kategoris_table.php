<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategoris', function (Blueprint $table) {
            // WAJIB ADA 'kategori_id' DI DALAM PARAMETER id()
            $table->id('kategori_id'); 
            $table->string('nama_kategori', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};