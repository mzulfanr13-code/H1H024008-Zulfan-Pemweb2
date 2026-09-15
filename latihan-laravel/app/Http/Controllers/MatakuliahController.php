<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    // Data statis 5 matakuliah dengan atribut kode, nama, dan sks
    private array $daftarMatakuliah = [
        ['kode' => 'TKV201', 'nama' => 'Pemrograman Web II', 'sks' => 3],
        ['kode' => 'TKV202', 'nama' => 'Sistem Basis Data', 'sks' => 3],
        ['kode' => 'TKV203', 'nama' => 'Sistem Tertanam', 'sks' => 4],
        ['kode' => 'TKV204', 'nama' => 'Praktikum Algoritma', 'sks' => 1],
        ['kode' => 'TKV205', 'nama' => 'Jaringan Komputer', 'sks' => 2],
    ];

    public function index(Request $request)
    {
        // Menangkap query string dari URL (contoh: ?q=sistem)
        $kataKunci = $request->query('q');
        $data = $this->daftarMatakuliah;

        // Jika form pencarian diisi, lakukan filter pada array
        if ($kataKunci) {
            $data = array_filter($data, function ($mk) use ($kataKunci) {
                // Menggunakan stripos agar pencarian kebal huruf besar/kecil (case-insensitive)
                return stripos($mk['nama'], $kataKunci) !== false;
            });
        }

        // Kirim data matakuliah (hasil filter) dan kata kunci kembali ke view
        return view('matakuliah.index', [
            'daftarMatakuliah' => $data,
            'kataKunci' => $kataKunci
        ]);
    }

    public function show(string $kode)
    {
        // Mencari matakuliah berdasarkan kode menggunakan Collection Laravel
        $kumpulanData = collect($this->daftarMatakuliah);
        $mk = $kumpulanData->firstWhere('kode', $kode);

        // Jika kode tidak ditemukan, kembalikan galat 404
        if (!$mk) {
            abort(404, 'Matakuliah tidak ditemukan');
        }

        // Mengirim satu data matakuliah spesifik ke view matakuliah.show
        return view('matakuliah.show', ['mk' => $mk]);
    }
}