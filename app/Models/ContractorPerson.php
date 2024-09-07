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


class ContractorPerson extends Authenticatable  implements HasMedia , TranslatableContract
{
    protected $table = 'contractor_persons';

    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    use HasApiTokens, Notifiable;

    public $translatedAttributes = ['contractor_person_name' , 'contractor_person_address'];

   
    protected $fillable = [
        'year_of_experience',
        'membership_no',
        'country_id',
        'city_id',
        'email',
        'phone',
        'image',
        'company_id',
        'specialty_id',
        'rate',
        'review',
        'status'
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class,'specialty_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }


    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    } 

    public function projects()
    {
        return $this->hasMany(OtherProject::class,'contractor_person_id','id');
    }

}
