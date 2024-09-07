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
class ServiceCompany extends Authenticatable  implements HasMedia , TranslatableContract
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
        'rate',
        'country_id',
        'status',
        'heart'
    ];


    public function specialty()
    {
        return $this->belongsTo(Specialty::class,'specialty_id','id');
    }

    public function subspecialties()
    {
        return $this->belongsToMany(Subspecialty::class,'subspecialty_id','id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }





    // protected $fillable = [
    //     'email', 'phone', 'location', 'number_of_employees', 'number_of_branches', 'year_of_experience', 'rate',
    //     'commercial_registration_certificate', 'vat_certificate', 'social_insurance_certificate',
    //     'chamber_of_commerce_certificate', 'company_profile', 'specialty_id', 'status'
    // ];

    // public function specialties()
    // {
    //     return $this->belongsTo(Specialty::class, 'specialty_id');
    // }

    // public function subspecialties()
    // {
    //     return $this->belongsToMany(Subspecialty::class, 'consulting_company_subs', 'service_company_id', 'subspecialty_id');
    // }














































     // protected function getImageAttribute($value)
    // {
    //     if ($value) {
    //         return asset('media/ConsultingCompanyFile' . '/' . $value);
    //     } else {
    //         return asset('media/ConsultingCompanyFile/default.png');
    //     }
    // }

    // public function setImageAttribute($value)
    // {
    //     if ($value) {
    //         $imageName = time() . '.' . $value->getClientOriginalExtension();
    //         $value->move(public_path('media/ConsultingCompanyFile/'), $imageName);
    //         $this->attributes['commercial_registration_certificate'] = $imageName;

    //     }
    // }

    // protected function getCommercialRegistrationCertificateAttribute($value)
    // {
    //     if ($value) {
    //         return asset('media/ConsultingCompanyFile' . '/' . $value);
    //     } else {
    //         return asset('media/ConsultingCompanyFile/default.png');
    //     }
    // }

    // public function setCommercialRegistrationCertificateAttribute($value)
    // {
    //     if ($value) {
    //         $imageName = time() . '.' . $value->getClientOriginalExtension();
    //         $value->move(public_path('media/ConsultingCompanyFile/'), $imageName);
    //         $this->attributes['commercial_registration_certificate'] = $imageName;

    //     }
    // }


    // protected function getVATCertificateAttribute($value)
    // {
    //     if ($value) {
    //         return asset('media/ConsultingCompanyFile' . '/' . $value);
    //     } else {
    //         return asset('media/ConsultingCompanyFile/default.png');
    //     }
    // }

    // public function setVATCertificateAttribute($value)
    // {
    //     if ($value) {
    //         $imageName = time() . '.' . $value->getClientOriginalExtension();
    //         $value->move(public_path('media/ConsultingCompanyFile/'), $imageName);
    //         $this->attributes['vat_certificate'] = $imageName;

    //     }
    // }



    // protected function getSocialInsuranceCertificateAttribute($value)
    // {
    //     if ($value) {
    //         return asset('media/ConsultingCompanyFile' . '/' . $value);
    //     } else {
    //         return asset('media/ConsultingCompanyFile/default.png');
    //     }
    // }

    // public function setSocialInsuranceCertificateAttribute($value)
    // {
    //     if ($value) {
    //         $imageName = time() . '.' . $value->getClientOriginalExtension();
    //         $value->move(public_path('media/ConsultingCompanyFile/'), $imageName);
    //         $this->attributes['social_insurance_certificate'] = $imageName;

    //     }
    // }


    // protected function getChamberofCommerceCertificateAttribute($value)
    // {
    //     if ($value) {
    //         return asset('media/ConsultingCompanyFile' . '/' . $value);
    //     } else {
    //         return asset('media/ConsultingCompanyFile/default.png');
    //     }
    // }

    // public function setChamberofCommerceCertificateAttribute($value)
    // {
    //     if ($value) {
    //         $imageName = time() . '.' . $value->getClientOriginalExtension();
    //         $value->move(public_path('media/ConsultingCompanyFile/'), $imageName);
    //         $this->attributes['chamber_of_commerce_certificate'] = $imageName;

    //     }
    // }


    // protected function getCompanyProfileAttribute($value)
    // {
    //     if ($value) {
    //         return asset('media/ConsultingCompanyFile' . '/' . $value);
    //     } else {
    //         return asset('media/ConsultingCompanyFile/default.png');
    //     }
    // }

    // public function setCompanyProfileAttribute($value)
    // {
    //     if ($value) {
    //         $imageName = time() . '.' . $value->getClientOriginalExtension();
    //         $value->move(public_path('media/ConsultingCompanyFile/'), $imageName);
    //         $this->attributes['company_profile'] = $imageName;

    //     }
    // }

}