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
        "birth_date",
        "address",
        "phone_number",
        "email",
        "github_url",
        "linkedin_url",
        "profile_image",
        "curriculum",
        "performance",
        "user_id",
    ];

    // Relazione One-to-One con "User"
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //crea relazione many to many verso la tabella technologies
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    //crea relazione many to many verso la tabella fields
    public function fields()
    {
        return $this->belongsToMany(Field::class);
    }

    //crea relazione many to many verso la tabella sponsorships
    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class);
    }

    //crea relazione one to many verso la tabella leads
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    //crea relazione one to many verso la tabella reviews
    public function reviews()
    {
        return $this->hasMany(Lead::class);
    }
}
