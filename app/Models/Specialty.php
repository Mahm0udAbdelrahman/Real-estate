<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Specialty extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name'];
    protected $fillable = [

        'status'
    ];


    public function subspecialties()
    {
        return $this->hasMany(Subspecialty::class,'specialty_id','id');
    }

    // public function translations()
    // {
    //     return $this->hasMany(Translation::class, 'model_id');
    // }


    public function contractors()
    {
        return $this->hasMany(Contractor::class,'specialty_id','id');
    }

    public function contractorPersons()
    {
        return $this->hasMany(ContractorPerson::class,'specialty_id','id');
    }

    public function partners()
    {
        return $this->hasMany(Partner::class,'specialty_id','id');
    }


    public function ManagerPerson()
    {
        return $this->hasMany(ManagerPerson::class,'specialty_id','id');
    }

    public function ManagerCompany()
    {
        return $this->hasMany(ManagerCompany::class,'specialty_id','id');
    }

    public function ServiceCompany()
    {
        return $this->hasMany(ServiceCompany::class,'specialty_id','id');
    }


    public function ServicePerson()
    {
        return $this->hasMany(ServicePerson::class,'specialty_id','id');
    }


    public function serviceCompanies()
    {
        return $this->hasMany(ServiceCompany::class, 'specialty_id');
    }

}