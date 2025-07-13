<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResearchAndDevelopmentProject extends Model
{
    protected $fillable = [
        'project_name',
        'start_date',
        'end_date',
        'lead_researcher_id',
        'description',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the lead researcher for this project.
     */
    public function leadResearcher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lead_researcher_id');
    }

    /**
     * Get the status options for R&D projects.
     */
    public static function getStatusOptions(): array
    {
        return [
            'planning' => 'Planning',
            'in_progress' => 'In Progress',
            'testing' => 'Testing',
            'completed' => 'Completed',
            'on_hold' => 'On Hold',
            'cancelled' => 'Cancelled',
        ];
    }
}
