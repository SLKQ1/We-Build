<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Chat extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chats';

    protected $fillable = ['name'];

    /**
     * Public function to get all the users for this chat
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('user_id', 'created_at', 'updated_at');
    }
    
    /**
     * Public function to get all the messages for this chat
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
