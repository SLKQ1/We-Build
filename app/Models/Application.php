<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    
    // Application statuses 
    const PENDING = 0; 
    const ACCEPTED = 1; 
    const REJECTED = 2; 

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
}