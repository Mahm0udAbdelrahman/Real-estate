<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $caregories = Category::all();
        return ApiResource::getResponse(201, 'all data', CategoryResource::collection($caregories));
    }
}