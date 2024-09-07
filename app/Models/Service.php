<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Service extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name'];

    protected $fillable = ['subspecialty_id','status'];


    public function subspecialty()
    {
        return $this->belongsTo(Subspecialty::class,'subspecialty_id','id');
    }

    public function ServiceCompany()
    {
        return $this->hasMany(ServiceCompany::class,'service_id','id');
    }

    public function ServicePerson()
    {
        return $this->hasMany(ServicePerson::class,'service_id','id');
    }

     public function ManagerCompany()
    {
        return $this->hasMany(ManagerCompany::class,'service_id','id');
    }

     public function ManagerPerson()
    {
        return $this->hasMany(ManagerPerson::class,'service_id','id');
    }





}
