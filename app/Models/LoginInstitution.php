<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginInstitution extends Model
{
    use HasFactory;


    protected $fillable = [
        'number',
    ];

    public function VerificationCode()
    {
        return $this->hasMany(VerificationCode::class,'login_institution_id','id');
    }
}