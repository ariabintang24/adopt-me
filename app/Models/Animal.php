<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AdoptionRequest;

class Animal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'category_id',
        'age_range',
        'gender',
        'description',
        'status',
        'created_by',
    ];

    protected $casts = [
        'age' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(AnimalImage::class);
    }

    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    // public function favorites()
    // {
    //     return $this->hasMany(Favorite::class);
    // }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')
            ->withTimestamps();
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // helper
    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    public function getAgeAttribute()
    {
        return match ($this->age_range) {
            '0-11' => '0–11 months',
            '1-3'  => '1–3 years',
            '3-5'  => '3–5 years',
            '5+'   => '5+ years',
            default => '-',
        };
    }

    public function isFavoritedBy($user)
    {
        if (!$user) {
            return false;
        }

        return $this->favorites()
            ->where('user_id', $user->id)
            ->exists();
    }
}
