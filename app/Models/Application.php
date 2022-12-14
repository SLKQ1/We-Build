<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    // Application statuses 
    const PENDING = 1;
    const VIEWED = 2;
    const ACCEPTED = 3;
    const REJECTED = 4;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'applications';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Public function to get the user for this application
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Public function to get the project for this application
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
