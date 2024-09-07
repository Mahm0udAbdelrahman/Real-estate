<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class RegisterCompany extends Authenticatable implements HasMedia , TranslatableContract
{
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    use HasApiTokens, Notifiable;

    protected $table = 'register_companies';

    protected $fillable = ['email','image','status','phone','number_of_employees','country_id','location'];
    public $translatedAttributes = ['company_name','bio'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}