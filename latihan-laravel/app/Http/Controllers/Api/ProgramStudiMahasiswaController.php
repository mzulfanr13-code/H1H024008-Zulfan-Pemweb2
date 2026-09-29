<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MahasiswaResource;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiMahasiswaController extends Controller
{
    public function index(Request $request, $id)
    {
        // Pastikan program studi ada (opsional, jika ingin mengembalikan 404 jika prodi tidak ada)
        $programStudi = ProgramStudi::findOrFail($id);

        $perHalaman = min($request->integer('per_halaman', 10), 100);
        
        $mahasiswa = Mahasiswa::where('program_studi_id', $id)->with('programStudi')->paginate($perHalaman);

        return MahasiswaResource::collection($mahasiswa);
    }
}