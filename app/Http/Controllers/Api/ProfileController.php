<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function me(){
        $me = auth('api')->user();
        return $this->successResponse(200, $me, 'List Of currencies');
    }
}
