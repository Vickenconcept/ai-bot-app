<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conversation;

class Message extends Model
{
    use HasFactory;

    public $guarded = [];

    public function conversations(){
        return $this->belongsTo(Conversation::class);
    }
}
