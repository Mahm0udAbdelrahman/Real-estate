<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorPersonTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['contractor_person_name', 'contractor_person_address'];
}

