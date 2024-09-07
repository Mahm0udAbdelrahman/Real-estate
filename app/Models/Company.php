<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Company extends Model implements TranslatableContract , HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    

    protected $guard = 'Company';

    protected $table = 'Companies';
    public $translatedAttributes = ['name', 'address', 'description'];

    protected $fillable = ['country_id','phone','image','status'];
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function contractors()
    {
        return $this->hasMany(Contractor::class,'company_id','id');
    }

    public function support_services()
    {
        return $this->hasMany(SupportService::class,'company_id','id');
    }

    public function contractorPersons()
    {
        return $this->hasMany(ContractorPerson::class,'company_id','id');
    }
}