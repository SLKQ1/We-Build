<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    protected $fillable = ['message', 'chat_id'];

    /**
     * Public function to get the user this message belongs to
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
