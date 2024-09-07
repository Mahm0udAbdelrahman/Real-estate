<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'admin_id',
        'answer',
        'answer_details',

    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id','id');
    }


    
}