<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdoptionRequest extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_AUTO_REJECTED = 'auto_rejected';

    const AUTO_REJECT_NOTE =
    'Automatically rejected because this animal has been adopted by another applicant.';

    protected $fillable = [
        'user_id',
        'animal_id',
        'reason',
        'has_experience',
        'residence_type',
        'other_pets',
        'other_pets_detail',
        'status',
        'admin_note',
        'approved_at',
        'approved_by',
    ];

    protected $table = 'adopt_requests';

    protected $casts = [
        'has_experience' => 'boolean',
        'other_pets' => 'boolean',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Helper
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function getStatusLabelAttribute() //status_label
    {
        return match ($this->status) {
            'pending'        => 'Pending',
            'approved'       => 'Approved',
            'rejected'       => 'Rejected',
            'auto_rejected'  => 'Auto Rejected',
            default          => ucfirst(str_replace('_', ' ', $this->status)),
        };
    }
}
