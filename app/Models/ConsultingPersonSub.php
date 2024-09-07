<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultingPersonSub extends Model
{
    use HasFactory;


    protected $table='consulting_person_subs';

    protected $fillable = [
        'service_person_id',
        'subspecialty_id',

    ];


    public function person()
    {
        $this->belongsTo(ServicePerson::class,'service_person_id');
    }

    public function subspecialty()
    {
        $this->belongsTo(Subspecialty::class,'subspecialty_id');
    }
}