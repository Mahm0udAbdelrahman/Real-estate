<?php

namespace App\Http\Controllers\Api;

use App\Models\Country;
use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    public function getCountry()
    {
        $data = Country::latest()->get();
        // if (count($data) > 0) {
        //     if ($data->total() > $data->perPage()) {
        //         $customDate = [
        //             'data' => CountryResource::collection($data),
        //             'pagination_data' => [
        //                 'currentPage' => $data->currentPage(),
        //                 'perPage' => $data->perPage(),
        //                 'total' => $data->total(),
        //                 'links' => [
        //                         'first' => $data->url(1),
        //                         'last' => $data->lastPage(),
        //                     ],
        //             ],

        //         ];

        //     } else {
                $customDate = CountryResource::collection($data);
            // }

            return ApiResource::getResponse(201, 'all data', $customDate);
        // } 
        // else {
        //     return ApiResource::getResponse(401, 'no data', []);
        // }

    }
}