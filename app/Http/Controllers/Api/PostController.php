<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(4);

        $customDate= response()->json(
           PostResource::collection($posts)->response()->getData()
        );

        return ApiResource::getResponse(201, 'all data',  $customDate);

    }
}