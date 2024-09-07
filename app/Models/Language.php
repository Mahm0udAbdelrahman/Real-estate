<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model implements HasMedia
{
    use HasFactory ,  SoftDeletes;
    use InteractsWithMedia;


    protected $fillable = [
        'name',
        'abbreviations',
        'flag',
        'status',
    ];

    public function countries()
    {
        return $this->hasMany(Country::class);
    }
    public function translates()
    {
        return $this->hasMany(Translation::class,'language_id','id');
    }

    public function DataPaymentMethod()
    {
        return $this->hasMany(DataPaymentMethod::class,'language_id','id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'language_id','id');
    }


}