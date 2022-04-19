<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class MiningController extends Controller
{
    public function index(){
        return view('pages.mining');
    }
}
