<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
        return response()->json([
            'message' => 'All systems are a go',
            'status' => true,
            'users' => \App\Models\User::all(),
        ]);
    }
    function findWeatherOfAllUsers(){
        if(WeatherService::findWeatherOfAllUsers()){
            return response()->json([
                'message' => 'Data fetched successfully',
                'status' => true,
            ]);
        }else{
            return response()->json([
                'message' => 'Something went wrong',
                'status' => false,
            ], 400);
        }

    }
}
