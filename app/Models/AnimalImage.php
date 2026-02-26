<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnimalImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'animal_id',
        'image',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
