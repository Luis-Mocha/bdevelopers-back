<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $table = 'fields';

    protected $fillable = [
        "name",
        "slug",
    ];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
