<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;

class Bot extends Model
{
    use HasFactory;

    public $guarded = [];

    public function user() {
        
        return $this->belongsTo(User::class);
    }
}
