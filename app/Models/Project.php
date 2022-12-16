<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    // Project statuses 
    const OPEN = 0;
    const IN_PROGRESS = 1;
    const DONE = 2;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * Public function to get all the users for this project
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
