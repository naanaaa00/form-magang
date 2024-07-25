<?php

namespace App\Http\Controllers;

use App\Models\Tb_Lokasi;
use App\Models\Tb_Kabupaten;
use Illuminate\Http\Request;
use App\Models\Tb_Pengajuan_Kuker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    public function index()
    {
        return view('pengajuan.index');
    }

    public function create()
    {
        // Fetch kabupaten and lokasi data
        $kabupatens = Tb_Kabupaten::all();
        $lokasis = Tb_Lokasi::all();

        return view('pengajuan.create', compact('kabupatens', 'lokasis'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            "nama_perwakilan" => "required",
            "email" => "required|email",
            "no_hp" => "required",
            "no_hp_alternatif" => "required",
            "nama_instansi" => "required",
            "alamat_instansi" => "required",
            "tanggal" => "nullable|date",
            "jam" => "nullable|date_format:H:i",
            "topik_diskusi" => "required",
            "jumlah_peserta" => "nullable|integer",
            'kabupaten_id' => 'required|exists:tb_kabupaten,id',
            'lokasi_id' => 'required|exists:tb_lokasi,id',
            "nama_peserta" => "nullable|array",
            "cv" => "nullable|file|mimes:pdf", // Mengubah validasi cv menjadi satu file
            "surat_pengajuan" => "nullable|file|mimes:pdf",
        ]);

        // Proses upload file CV jika ada
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filename = time() . '_cv.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('', $filename, 'public_tb_pengajuan_cv');
            $validatedData['cv'] = $filename; // Simpan nama file saja
        }

        // Proses upload file surat pengajuan jika ada
        if ($request->hasFile('surat_pengajuan')) {
            $file = $request->file('surat_pengajuan');
            $filename = time() . '_surat.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('', $filename, 'public_tb_pengajuan_surat');
            $validatedData['surat_pengajuan'] = $filename;
        }

        // Encode nama peserta sebagai JSON jika ada data
        if (isset($validatedData['nama_peserta']) && is_array($validatedData['nama_peserta'])) {
            $validatedData['nama_peserta'] = implode('<br/>', $validatedData['nama_peserta']); // Menggunakan implode untuk membuat string
        }

        // Simpan data ke database
        $newPengajuan = Tb_Pengajuan_Kuker::create($validatedData);

        // Redirect ke halaman yang sesuai
        return response()->json([
            'status' => 'success',
            'message' => 'Pengajuan berhasil disimpan.',
            'data' => $newPengajuan
        ], 201);
    }


}
