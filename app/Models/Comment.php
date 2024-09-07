<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected $fillable = ['language_id','description'];


    public function language()
    {
        return $this->belongsTo(Language::class,'language_id','id');
    }


}