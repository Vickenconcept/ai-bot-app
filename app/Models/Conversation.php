<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use APP\Models\User;
use App\Models\Message;
use App\Models\Bot;
use App\Models\Scopes\ExemptionAccessScope;
use App\Models\Trait\CourseSluggable;
use App\Models\Trait\UUID;

class Conversation extends Model
{
    use HasFactory, CourseSluggable, UUID;

      public $guarded = [];

      protected $casts = [
        'image_link' => 'array',
        'productPrice' => 'array',
        'temp_three' => 'array',
        'temp_four' => 'array',
        'temp_five' => 'array',
        'users_contact_info' => 'array',
    ];

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

        static::addGlobalScope(new ExemptionAccessScope);

        static::deleting(function ($conversation) {
            // Delete the associated messages
            $conversation->messages()->delete();
        });
    }
    // protected function updatedAt(): Attribute
    // {
    //     return Attribute::get(fn ($value) => Carbon::parse($value)->format('F j, Y, g:i A'));
    // }

    
}
