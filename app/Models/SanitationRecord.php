<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanitationRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'area',
        'sanitation_date',
        'performed_by',
        'notes',
        'status',
    ];

    protected $casts = [
        'sanitation_date' => 'date',
    ];

    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
