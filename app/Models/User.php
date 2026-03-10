<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;


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
        'slug',
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {

            $baseSlug = Str::slug($user->name);
            $slug = $baseSlug;

            $count = 1;

            while (User::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . rand(10, 999);
                $count++;
            }

            $user->slug = $slug;
        });
    }



    // Public

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin'); //hanya admin yang bisa masuk
    }

    public function adoptions(): HasMany
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    // User has many adoption requests
    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class, 'user_id');
    }

    // User (admin) approved many adoption requests
    public function approvedAdoptions()
    {
        return $this->hasMany(AdoptionRequest::class, 'approved_by');
    }

    // User has many favorites
    public function favorites()
    {
        return $this->belongsToMany(Animal::class, 'favorites')
            ->withTimestamps();
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

    public function animals()
    {
        return $this->hasMany(Animal::class, 'created_by');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
