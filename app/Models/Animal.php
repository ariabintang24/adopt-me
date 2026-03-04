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
        'age',
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
        $months = $this->age_in_months;

        $years = floor($months / 12);
        $remainingMonths = $months % 12;

        if ($years > 0 && $remainingMonths > 0) {
            return $years . ' year' . ($years > 1 ? 's' : '') . ' ' .
                $remainingMonths . ' month' . ($remainingMonths > 1 ? 's' : '');
        }

        if ($years > 0) {
            return $years . ' year' . ($years > 1 ? 's' : '');
        }

        return $remainingMonths . ' month' . ($remainingMonths > 1 ? 's' : '');
    }
}
