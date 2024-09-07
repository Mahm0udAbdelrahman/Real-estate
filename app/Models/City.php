<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class City extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['status','country_id'];


    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function contractors()
    {
        return $this->hasMany(Contractor::class,'city_id','id');
    }
    public function contractorPersons()
    {
        return $this->hasMany(ContractorPerson::class,'city_id','id');
    }
    public function suppliers()
    {
        return $this->hasMany(Supplier::class,'city_id','id');
    }

    public function partners()
    {
        return $this->hasMany(Partner::class,'city_id','id');
    }
}