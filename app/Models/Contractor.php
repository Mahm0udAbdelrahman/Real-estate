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

class Contractor extends Authenticatable implements HasMedia , TranslatableContract
{
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    use HasApiTokens, Notifiable;
    protected $table = 'contractors';

    public $translatedAttributes = ['contractor_name' , 'contractor_address'];


    protected $fillable = [
        'number_of_hours',
        'company_size',
        'membership_no',
        'country_id',
        'city_id',
        'email',
        'phone',
        'image',
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


    // public function company()
    // {
    //     return $this->belongsTo(Company::class,'company_id','id');
    // }
    // public function code()
    // {
    //     $this->membership_no = rand(10000000,99999999);
    //     $this->save();
    // }
}