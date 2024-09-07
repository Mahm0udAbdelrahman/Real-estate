<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AddInsurance extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'insurance_id',
        'birthday',
        'insurance_card_number',
        'insurance_expiry_date',
        'image',
        'status'
    ];

    public function insurance()
    {
        return $this->belongsTo(Insurance::class,'insurance_id','id');
    }
}