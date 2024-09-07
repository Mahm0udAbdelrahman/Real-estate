<?php

namespace App\Models;

use App\Models\Language;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Country extends Model implements HasMedia , TranslatableContract
{
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;

    public $translatedAttributes = ['name'];

    protected $fillable = ['abbreviation','code','flag','status'];

    public function cities()
    {
        return $this->hasMany(City::class,'country_id','id');
    }
    public function companies()
    {
        return $this->hasMany(Company::class,'country_id','id');
    }
    public function contractors()
    {
        return $this->hasMany(Contractor::class,'country_id','id');
    }

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function contractorPersons()
    {
        return $this->hasMany(ContractorPerson::class,'country_id','id');
    }
    public function suppliers()
    {
        return $this->hasMany(Supplier::class,'country_id','id');
    }

    public function partners()
    {
        return $this->hasMany(Partner::class,'country_id','id');
    }

    public function opts()
    {
        return $this->hasMany(OTP::class,'country_id','id');
    }

}