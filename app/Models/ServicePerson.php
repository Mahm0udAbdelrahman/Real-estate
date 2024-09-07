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
class ServicePerson extends Authenticatable implements HasMedia , TranslatableContract
{
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    use HasApiTokens, Notifiable;

    protected $table = 'service_persons';
    public $translatedAttributes = ['full_name','academic_degree'];
    protected $fillable = [
        'email',
        'phone',
        'age',
        'year_of_experience',
        'national_id',
        'freelance_license',
        'cv',
        'latest_academic_degree',
        'profile_photo',
        'service_type',
        'specialty_id',
        'country_id',
        'status',
        'heart'
    ];


    public function specialty()
    {
        return $this->belongsTo(Specialty::class,'specialty_id','id');
    }




    public function subspecialty()
    {
        return $this->belongsTo(Subspecialty::class,'subspecialty_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }






}