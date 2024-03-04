<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Document;
use App\Models\Bot;
use App\Models\Scopes\ExemptionAccessScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Content extends Model
{
    use HasFactory;

    public $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bot() {
        
        return $this->belongsTo(Bot::class, 'bot_id');
    }
    public function documents(){
        return $this->hasMany(Document::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ExemptionAccessScope);
        
        static::deleting(function ($contents) {
                    // Delete the associated messages
                    $contents->documents()->delete();
                });
    }
    protected function updatedAt(): Attribute
    {
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('F j, Y, g:i A'));
    }
    protected function createdAt(): Attribute
    {
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('F j, Y, g:i A'));
    }

   
}
