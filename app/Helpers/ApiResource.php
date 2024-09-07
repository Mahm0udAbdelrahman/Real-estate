<?php
namespace App\Helpers;


class ApiResource
{

    public static function getResponse($code , $msg=null , $data=null)
    {
        $response = [
            'code' => $code,
            'massage' =>$msg,
            'data' => $data,

        ];

        return response()->json($response,$code);
    }
}