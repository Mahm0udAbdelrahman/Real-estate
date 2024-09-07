<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterConsultingServiceCompanyTranslation extends Model
{
    use HasFactory;
    protected $table = 'service_company_translations';

    public $timestamps = false;
    protected $fillable = ['name'];



}