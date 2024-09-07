<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultingCompanySub extends Model
{
    use HasFactory;

    protected $table='consulting_company_subs';

    protected $fillable = [
        'service_company_id',
        'subspecialty_id',
    ];

    public function company()
    {
        $this->belongsTo(ServiceCompany::class,'service_company_id');
    }

    public function subspecialty()
    {
        $this->belongsTo(Subspecialty::class,'subspecialty_id');
    }
}