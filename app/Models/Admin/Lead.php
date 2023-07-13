<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads';
    protected $fillable = [
        "name",
        "surname",
        "email",
        "message"
    ];

    //crea relazione one to many verso profiles
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
