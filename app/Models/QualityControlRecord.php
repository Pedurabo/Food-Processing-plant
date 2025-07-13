<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityControlRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'inspection_date',
        'inspector_id',
        'result',
        'notes',
    ];

    protected $casts = [
        'inspection_date' => 'date',
    ];

    public function batch()
    {
        return $this->belongsTo(ProductionBatch::class, 'batch_id');
    }

    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }
}
