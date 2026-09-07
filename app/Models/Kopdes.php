<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kopdes extends Model
{
    //

    use HasFactory;

    protected $table = 'kopdes';

    protected $fillable = [
        'nama_kopdes',
        'alamat',
        'tanggal_berdiri',
        'Pendidikan_terakhir',
        'foto_kopdes',
        'manager_id',
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class, 'manager_id', 'id');
    }
}
