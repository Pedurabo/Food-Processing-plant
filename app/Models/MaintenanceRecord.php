<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_name',
        'maintenance_date',
        'performed_by',
        'description',
        'status',
    ];

    protected $casts = [
        'maintenance_date' => 'date',
    ];

    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
