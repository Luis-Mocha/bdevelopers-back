<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $table = 'technologies';

    protected $fillable = [
        "name",
        "slug",
        "type",
    ];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
