<?php

namespace App\Models;

use Laravel\Cashier\Billable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory , HasRoles , Billable;

    protected $guard = 'admin';

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        'status'
    ];


    protected function getImageAttribute($value)
    {
        if ($value) {
            return asset('media/admin' . '/' . $value);
        } else {
            return asset('media/admin/default.png');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value) {
            $imageName = time() . '.' . $value->getClientOriginalExtension();
            $value->move(public_path('media/admin/'), $imageName);
            $this->attributes['image'] = $imageName;
        }
    }

    public function verificationcode()
    {
        return $this->hasMany(VerificationCode::class,'admin_id','id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class,'admin_id','id');
    }
}