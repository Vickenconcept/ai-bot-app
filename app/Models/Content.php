<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Document;

class Content extends Model
{
    use HasFactory;

    public $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function documents(){
        return $this->hasMany(Document::class);
    }
}
