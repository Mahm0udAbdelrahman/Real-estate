<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    use HasFactory;



    protected $fillable = [
        'code',
        'admin_id',
    ];

    public function loginInstitution()
    {
        return $this->belongsTo(Admin::class,'admin_id','id');
    }
}