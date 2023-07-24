<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = [
        "profile_id",
        "vote",
        "description",
        "name",
        "surname",
        "date"
    ];

    //crea relazione one to many verso profiles
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
