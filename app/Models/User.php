<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use Filament\Panel;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $guard_name = 'web';


    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin');
    }

    // User has many adoption requests
    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    // User (admin) approved many adoption requests
    public function approvedAdoptions()
    {
        return $this->hasMany(AdoptionRequest::class, 'approved_by');
    }

    // User has many favorites
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // Shortcut: user favorite animals
    public function favoriteAnimals()
    {
        return $this->belongsToMany(
            Animal::class,
            'favorites'
        )->withTimestamps();
    }

    // Animals created by admin
    public function createdAnimals()
    {
        return $this->hasMany(Animal::class, 'created_by');
    }
}
