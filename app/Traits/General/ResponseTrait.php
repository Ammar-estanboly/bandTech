<?php

namespace App\Traits\General;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait ResponseTrait {


    public function formatResponse(bool $status,$data,string $message,int $code,$errors): JsonResponse
        {
        $response = [
            "success" => $status,
            "data"    => $data,
            'status_code'=> $code,
            "message" =>$message,
            "errors"=>$errors
        ];

        return response()->json($response,$code);
    }



}
