<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Matakuliah; // <-- Pastikan ini ditambahkan

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        $daftar = [
            ['kode' => 'MK01', 'nama' => 'Pemrograman Web II', 'sks' => 3, 'semester' => 4],
            ['kode' => 'MK02', 'nama' => 'Basis Data Lanjut', 'sks' => 3, 'semester' => 4],
            ['kode' => 'MK03', 'nama' => 'Kecerdasan Buatan', 'sks' => 3, 'semester' => 5],
        ];

        foreach ($daftar as $item) {
            Matakuliah::create($item);
        }
    }
}