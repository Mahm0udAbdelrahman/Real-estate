<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements HasMedia , TranslatableContract
{
    use SoftDeletes;
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    public $translatedAttributes = ['name','description','words_guide','about','privacy','terms'];
    protected $fillable = ['language','logo','favicon','phone','email','whatsapp','facebook','twitter','instagram','youtube','status'];
}