<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $fillable = [
        "name",
        "surname",
        "user_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
