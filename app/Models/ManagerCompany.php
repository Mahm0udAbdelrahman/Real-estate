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

class ManagerCompany extends Authenticatable implements HasMedia , TranslatableContract
{
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    use HasApiTokens, Notifiable;
    public $translatedAttributes = ['company_name','bio'];
    protected $fillable = [
        'email',
        'phone',
        'location',
        'number_of_employees',
        'number_of_branches',
        'year_of_experience',
        'commercial_registration_certificate',
        'vat_certificate',
        'social_insurance_certificate',
        'chamber_of_commerce_certificate',
        'company_profile',
        'specialty_id',
        'country_id',
        'rate',
        'review',
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


    public function subspecialies()
    {
        return $this->belongsToMany(Subspecialty::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }



}