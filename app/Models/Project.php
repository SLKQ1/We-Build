<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    // Project statuses 
    const OPEN = 1;
    const IN_PROGRESS = 2;
    const DONE = 3;

    // Project multiplier value
    const MULTIPLIER_VAL = 0.2;
    // Project submission status
    const ON_TIME = '1';
    const LATE = '2';

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
        return $this->belongsToMany(User::class)->withPivot('created_at', 'updated_at', 'points');
    }

    /**
     * Public function to get all the applications for this project
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
