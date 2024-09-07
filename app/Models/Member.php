<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class Member extends Authenticatable
{
    use HasFactory , Billable;


    protected $guard = 'member';

    protected $table = 'members';


    protected $fillable = [
        'name',
        'phone',
        'email',
        'type',
        'birthday_date',
        'password',
        'status'
    ];
}