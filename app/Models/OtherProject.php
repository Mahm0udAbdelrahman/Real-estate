<?php

namespace App\Models;


use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class OtherProject extends Model implements HasMedia, TranslatableContract
{
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    public $translatedAttributes =
    [
        'title',
        'content',


    ];
    protected $fillable =
    [
        'logo',
        'image',
        'date',
        'status',
        'partner_id',
        'supplier_id',
        'contractor_id',
        'contractor_person_id',
        'rent_material_id',
        'manager_company_id',
        'manager_person_id',
        'service_company_id',
        'service_person_id',
        'register_company_id',
        'register_person_id',
        'heart'

    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function ServicePerson()
    {
        return $this->belongsTo(ServicePerson::class, 'service_person_id', 'id');
    }
    public function ServiceCompany()
    {
        return $this->belongsTo(ServiceCompany::class, 'service_company_id', 'id');
    }
    public function ManagerPerson()
    {
        return $this->belongsTo(ManagerPerson::class, 'manager_person_id', 'id');
    }
    public function ManagerCompany()
    {
        return $this->belongsTo(ManagerCompany::class, 'manager_company_id', 'id');
    }
    public function RentMaterial()
    {
        return $this->belongsTo(RentMaterial::class, 'rent_material_id', 'id');
    }
    public function ContractorPerson()
    {
        return $this->belongsTo(ContractorPerson::class, 'contractor_person_id', 'id');
    }
    public function Contractor()
    {
        return $this->belongsTo(Contractor::class, 'contractor_id', 'id');
    }
    public function Partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }
    public function Supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
