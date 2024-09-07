<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::all();
        return ApiResource::getResponse(201, 'Setting', SettingResource::collection($setting));
    }
}