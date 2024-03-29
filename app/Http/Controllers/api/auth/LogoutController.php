<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Traits\General\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    use ResponseTrait;

    public function logout() :JsonResponse{
        auth()->user()->tokens()->delete();
        return $this->formatResponse(true,'',"logged out",200,'');

    }
}
