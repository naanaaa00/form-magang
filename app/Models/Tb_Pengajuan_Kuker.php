<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tb_Pengajuan_Kuker extends Model
{
    use HasFactory;

    protected $table = 'tb_pengajuan_kuker';
    protected $primaryKey = 'id_pengajuan';
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        'id_pengajuan', 'nama_perwakilan', 'email', 'no_hp', 'no_hp_alternatif', 'nama_instansi', 'alamat_instansi',
        'tanggal', 'jam','topik_diskusi', 'jumlah_peserta', 'nama_peserta', 'cv', 'surat_pengajuan', 'kabupaten_id', 'lokasi_id'
    ];

    public function tb_lokasi()
    {
        return $this->belongsTo(Tb_Lokasi::class, 'lokasi_id', 'id');
    }

    public function tb_kabupaten()
    {
        return $this->belongsTo(Tb_Kabupaten::class, 'kabupaten_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_pengajuan)) {
                $model->id_pengajuan = static::generateIdPengajuan();
            }
        });
    }

    protected static function generateIdPengajuan()
    {
        // Generate random string of length 10
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);
    }


}
