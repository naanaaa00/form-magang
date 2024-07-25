<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'tb_kabupaten';

    protected $fillable = [
        'kabupaten',
    ];

    public function tb_pengajuan_kuker()
    {
        return $this->hasMany(Tb_Pengajuan_Kuker::class, 'kabupaten_id', 'id');
    }
}
