<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Content;

class Document extends Model
{
    use HasFactory;

    public $guarded = [];

    public function content(){
        return $this->belongsTo(Content::class);
    }
}
