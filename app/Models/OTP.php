<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 class OTP extends Model
{
    use HasFactory , HasApiTokens;

    protected $guard = 'otp';
    protected $table = 'o_t_p_s';
    protected $fillable = [
        'mobile',
        'code',
        'expire_at',
        'register_person_id',
        'register_company_id',
        'service_person_id',
        'service_company_id',
        'manager_person_id',
        'manager_company_id',
        'contractor_id',
        'contractor_person_id',
        'partner_id',
        'supplier_id',

    ];



    public function RegisterPerson()
    {
        return $this->belongsTo(RegisterPerson::class,'register_person_id','id');
    }
    public function RegisterCompany()
    {
        return $this->belongsTo(RegisterCompany::class,'register_company_id','id');
    }

    public function RegisterServiceCompany()
    {
        return $this->belongsTo(ServiceCompany::class,'service_company_id','id');
    }
    public function RegisterServicePerson()
    {
        return $this->belongsTo(ServicePerson::class,'service_person_id','id');
    }
    public function RegisterManagerCompany()
    {
        return $this->belongsTo(ManagerCompany::class,'manager_company_id','id');
    }
    public function RegisterManagerPerson()
    {
        return $this->belongsTo(ManagerPerson::class,'manager_person_id','id');
    }
    public function RegisterContractorCompany()
    {
        return $this->belongsTo(Contractor::class,'contractor_id','id');
    }
    public function RegisterContractorPerson()
    {
        return $this->belongsTo(ContractorPerson::class,'contractor_person_id','id');
    }
    public function RegisterSupplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public function RegisterPartner()
    {
        return $this->belongsTo(Partner::class,'partner_id','id');
    }



    public function generateCode()
    {
        $this->timestamps = false;
        $this->code = rand(10000,99999);
        $this->expire_at = now()->addMinutes(5);
        $this->save();
    }



}