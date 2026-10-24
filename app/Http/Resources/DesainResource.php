<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DesainResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->desain_id,
            'judul'       => $this->judul,
            'slug'        => $this->slug,
            'harga'       => (float) $this->harga,
            'deskripsi'   => $this->deskripsi,
            'gambar_url'  => $this->gambar ? (str_starts_with($this->gambar, 'http') ? $this->gambar : url('storage/' . $this->gambar)) : null,
            'kategori'    => [
                'id'   => $this->kategori_id,
                'nama' => $this->kategori?->nama_kategori,
            ],
            'created_at'  => $this->created_at?->toIso8601String(),
            'updated_at'  => $this->updated_at?->toIso8601String(),
        ];
    }
}