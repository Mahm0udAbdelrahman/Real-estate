<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['contractor_name', 'contractor_address'];
}