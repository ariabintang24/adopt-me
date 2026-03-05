<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnimal extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'category_id',
        'age_in_months',
        'gender',
        'description',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
