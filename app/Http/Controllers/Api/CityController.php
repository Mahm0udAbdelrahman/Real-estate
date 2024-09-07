<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;

class CityController extends Controller
{
    public function getCity($country_id)
    {
        $data = City::where('country_id', $country_id)->latest()->get();
        // if (count($data) > 0) {
        //     if ($data->total() > $data->perPage()) {
        //         $customDate = [
        //             'data' => CityResource::collection($data),
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
        //         return ApiResource::getResponse(201, '  pagination_data', $customDate);
        //     } else {
        //         $customDate = CityResource::collection($data);
        //     }
        $customDate = CityResource::collection($data);

        return ApiResource::getResponse(201, 'all data', $customDate);
        // } else {
        //     return ApiResource::getResponse(401, 'no data', []);
        // }

    }
}
