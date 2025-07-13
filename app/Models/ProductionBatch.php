<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_number',
        'product_name',
        'production_date',
        'quantity',
        'status',
        'operator_id',
    ];

    protected $casts = [
        'production_date' => 'date',
        'quantity' => 'integer',
    ];

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function qualityControlRecords()
    {
        return $this->hasMany(QualityControlRecord::class, 'batch_id');
    }
}
