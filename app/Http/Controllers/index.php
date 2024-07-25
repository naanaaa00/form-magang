<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_Kabupaten;
use App\Models\Tb_Lokasi;
use App\Models\Tb_Pengajuan_Kuker;

class PengajuanController extends Controller
{
    public function create()
    {
        // Fetch kabupaten and lokasi data
        $kabupatens = Tb_Kabupaten::all();
        $lokasis = Tb_Lokasi::all();

        return view('pengajuan.create', compact('kabupatens', 'lokasis'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'nama_perwakilan' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'no_hp_alternatif' => 'required|string|max:20',
            'nama_instansi' => 'required|string|max:255',
            'alamat_instansi' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'jam' => 'nullable|date_format:H:i',
            'topik_diskusi' => 'nullable|string|max:255',
            'jumlah_peserta' => 'required|integer|min:1',
            'kabupaten_id' => 'required|exists:tb_kabupaten,id',
            'lokasi_id' => 'required|exists:tb_lokasi,id',
            'cv' => 'required|file|mimes:pdf|max:2048',
            'surat_pengajuan' => 'required|file|mimes:pdf|max:2048',
            'nama_peserta.*' => 'required|string|max:255'
        ]);

        // Handle file uploads
        $cvPath = $request->file('cv')->store('cv', 'public');
        $suratPengajuanPath = $request->file('surat_pengajuan')->store('surat_pengajuan', 'public');

        // Create a new Pengajuan entry
        $pengajuan = Tb_Pengajuan_Kuker::create([
            'nama_perwakilan' => $request->nama_perwakilan,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'no_hp_alternatif' => $request->no_hp_alternatif,
            'nama_instansi' => $request->nama_instansi,
            'alamat_instansi' => $request->alamat_instansi,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'topik_diskusi' => $request->topik_diskusi,
            'jumlah_peserta' => $request->jumlah_peserta,
            'kabupaten_id' => $request->kabupaten_id,
            'lokasi_id' => $request->lokasi_id,
            'cv' => $cvPath,
            'surat_pengajuan' => $suratPengajuanPath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan berhasil disimpan.',
            'data' => $pengajuan
        ], 201);
    }
}
