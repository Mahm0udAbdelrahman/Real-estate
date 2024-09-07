<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class SupportService extends Model implements HasMedia , TranslatableContract
{
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;

    public $translatedAttributes = ['name' , 'type_jop','address'];

    protected $fillable = [
        'email',
        'phone',
        'salary',
        'image',
        'company_id',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}