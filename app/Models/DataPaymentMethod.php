<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPaymentMethod extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'model_id',
        'model_type',
        'attribute',
        'translate'

    ];

    public function language()
    {
        return $this->belongsTo(Language::class,'language_id','id');
    }
}
