<?php

namespace App\Models;

use App\Models\Scopes\DataAccessScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Content;

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

    public function contents() {
        
        return $this->hasMany(Content::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new DataAccessScope);
    }
}
