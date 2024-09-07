<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerComSub extends Model
{
    use HasFactory;

    protected $table='manager_com_subs';

    protected $fillable = [
        'manager_company_id',
        'subspecialty_id',

    ];


    public function company()
    {
        $this->belongsTo(ManagerCompany::class,'manager_company_id');
    }

    public function subspecialty()
    {
        $this->belongsTo(Subspecialty::class,'subspecialty_id');
    }
}