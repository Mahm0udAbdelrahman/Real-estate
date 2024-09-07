<?php

namespace App\Http\Controllers\Api;

use App\Models\Conference;
use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConferenceResource;
use App\Http\Resources\ConferenceShowResource;

class ConferenceController extends Controller
{
    public function index()
    {
        $Conferences = Conference::paginate(4);
        $customDate= response()->json(
           ConferenceResource::collection($Conferences)->response()->getData()
        );

        return ApiResource::getResponse(201, 'all data',  $customDate);
    }


    public function show($id)
    {
         
            $Conferences = Conference::find($id);
            if(!$Conferences){
                 
                return ApiResource::getResponse(404, 'ID not found'); 
            }

        return ApiResource::getResponse(201, 'Show Single Conference', ConferenceShowResource::make($Conferences));
        
   
    }
}