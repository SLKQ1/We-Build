<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectVotes extends Model
{
    use HasFactory;

    const UP_VOTE = 1;
    const DOWN_VOTE = 2;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * Public function to get the project for this application
    */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

}
