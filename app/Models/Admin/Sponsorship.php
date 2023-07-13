<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected $table = 'sponsorships';

    protected $fillable = [
        "name",
        "price",
        "duration",
    ];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
