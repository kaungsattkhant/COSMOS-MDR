<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\Common\CommonSerivce;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    //

    public function toggleIsActive(Request $request)
    {
        return CommonSerivce::toggleisActive($request);
    }
}
