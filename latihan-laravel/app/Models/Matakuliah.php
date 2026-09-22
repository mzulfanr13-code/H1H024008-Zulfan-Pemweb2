<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // 1. Tambahkan import ini

class Matakuliah extends Model
{
    protected $table = 'matakuliahs';
    protected $fillable = ['kode', 'nama', 'sks', 'semester'];

    // 2. Tambahkan method ini
    public function mahasiswas(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah')
                    ->withPivot('nilai')
                    ->withTimestamps();
    }
}