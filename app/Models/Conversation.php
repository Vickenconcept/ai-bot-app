<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use APP\Models\User;
use App\Models\Message;
use App\Models\Bot;
use App\Models\Scopes\DataAccessScope;

class Conversation extends Model
{
    use HasFactory;

      public $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function bot() {
        
        return $this->belongsTo(Bot::class, 'bot_id');
    }

    public function setDefaultBot(Bot $bot)
    {
        $this->bot()->associate($bot)->save();
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new DataAccessScope);
    }
}
