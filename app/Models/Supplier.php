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

class Supplier extends Authenticatable implements HasMedia, TranslatableContract
{
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    use HasApiTokens, Notifiable;
    protected $fillable = ['image', 'membership_no', 'location', 'email', 'phone', 'year_of_experience', 'supplied_material', 'city_id', 'country_id', 'rate','review', 'status'];
    public $translatedAttributes = ['name'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function projects()
    {
        return $this->hasMany(OtherProject::class,'supplier_id','id');
    }


}
