<?php

namespace App\Traits\General;

use Illuminate\Http\Request;

trait ResponseTrait {


    public function formatResponse($status,$data,$message,$code,$errors){


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
