<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventShowResource;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(4);

        $customDate= response()->json(
           EventResource::collection($events)->response()->getData()
        );

        return ApiResource::getResponse(201, 'all data',  $customDate);
    }


    public function show($id)
    {
       
         
            $events = Event::find($id);
            if(empty($events)){
                 
                return ApiResource::getResponse(404, 'NOT FOUND ID', []); 
            }
        return ApiResource::getResponse(201, 'Event', EventShowResource::make($events));
         
    }
}