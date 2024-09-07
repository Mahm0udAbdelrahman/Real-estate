<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Package extends Model implements HasMedia , TranslatableContract
{
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;

    public $translatedAttributes = ['name','time','description'];

    protected $fillable = ['price','image','status'];


    public function getRouteKeyName()
    {
        return 'price';
    }
}