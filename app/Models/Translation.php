<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'model_id',
        'model_type',
        'language_id',
        'attribute',
        'translate'

    ];

    public function language()
    {
        return $this->belongsTo(Language::class,'language_id','id');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'model_id');
    }

}