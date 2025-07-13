<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplyChainLogistic extends Model
{
    protected $fillable = [
        'item_name',
        'quantity',
        'supplier',
        'received_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'received_date' => 'date',
        'quantity' => 'integer',
    ];

    /**
     * Get the status options for supply chain items.
     */
    public static function getStatusOptions(): array
    {
        return [
            'ordered' => 'Ordered',
            'in_transit' => 'In Transit',
            'received' => 'Received',
            'inspected' => 'Inspected',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'returned' => 'Returned',
        ];
    }
}
