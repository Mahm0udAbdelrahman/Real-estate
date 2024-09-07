<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerPersonSub extends Model
{
    use HasFactory;

    protected $table='manager_person_subs';

    protected $fillable = [
        'manager_person_id',
        'subspecialty_id',

    ];


    public function person()
    {
        $this->belongsTo(ManagerPerson::class,'manager_person_id');
    }

    public function subspecialty()
    {
        $this->belongsTo(Subspecialty::class,'subspecialty_id');
    }
}