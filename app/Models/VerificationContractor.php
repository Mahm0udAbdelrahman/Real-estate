<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationContractor extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'contractor_id',
    ];

    public function doctor()
    {
        return $this->belongsTo(Contractor::class,'contractor_id','id');
    }
}