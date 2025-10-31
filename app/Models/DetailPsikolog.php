<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPsikolog extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_psikolog';

    protected $table = 'detail_psikolog';

    protected $fillable = [
        'id_psikolog',
        'bio',
        'harga',
    ];

    public function psikolog(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_psikolog');
    }
}