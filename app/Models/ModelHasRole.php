<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Contracts\Role;

class ModelHasRole extends Model
{
    use HasFactory;

    protected $table = 'model_has_roles';

    protected $fillable = [
        'role_id',
        'model_id',
    ];

    protected $attributes = [
        'model_type' => 'App\Models\User',
    ];    

    public function user()
    {
        return $this->belongsTo(User::class, 'model_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public $timestamps = false;

}