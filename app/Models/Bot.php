<?php

namespace App\Models;

use App\Models\Scopes\DataAccessScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;
use app\Models\Conversation;

class Bot extends Model
{
    use HasFactory;

    public $guarded = [];

    public function user() {
        
        return $this->belongsTo(User::class);
    }
    public function conversations() {
        
        return $this->hasMany(Conversation::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new DataAccessScope);
    }
}
