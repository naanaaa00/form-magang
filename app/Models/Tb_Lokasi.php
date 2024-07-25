<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_Lokasi extends Model
{
    use HasFactory;

    protected $table = 'tb_lokasi';

    protected $fillable = [
        'lokasi',
    ];

    public function tb_pengajuan_kuker()
    {
        return $this->hasMany(Tb_Pengajuan_Kuker::class, 'lokasi_id', 'id');
    }
}
