<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Manager extends Model
{
    use HasFactory;

    protected $table = 'managers';

    protected $fillable = [
        'foto_manager',
        'nama_manager',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat_manager',
        'Pendidikan_terakhir'
    ];

    public function kopdes(): HasOne
    {
        return $this->hasOne(Kopdes::class, 'manager_id', 'id');
    }
}
