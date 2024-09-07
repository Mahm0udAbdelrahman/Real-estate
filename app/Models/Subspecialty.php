<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Subspecialty extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name'];

    protected $fillable = ['specialty_id','status'];


    public function Specialty()
    {
        return $this->belongsTo(Specialty::class,'specialty_id','id');
    }


    public function service()
    {
        return $this->belongsTo(Service::class,'subspecialty_id','id');
    }

    public function ServiceCompany()
    {
        return $this->belongsToMany(ServiceCompany::class ,'subspecialty_id','id');
    }

    public function ServicePerson()
    {
        return $this->hasMany(ServicePerson::class,'subspecialty_id','id');
    }


    public function ManagerCompany()
    {
        return $this->hasMany(ManagerCompany::class,'subspecialty_id','id');
    }


    public function ManagerPerson()
    {
        return $this->hasMany(ManagerPerson::class,'subspecialty_id','id');
    }


    public function ManagerCompanies()
    {
        return $this->belongsToMany(ManagerCompany::class);
    }




}