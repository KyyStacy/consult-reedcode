<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_transaksi',
        'id_pasien',
        'id_psikolog',
        'harga',
        'status',
        'snap_token',
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    public function psikolog()
    {
        return $this->belongsTo(User::class, 'id_psikolog');
    }
    
}