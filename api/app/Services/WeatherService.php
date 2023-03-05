<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Error;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    /**
     * A static function that can be invoked from controller or schedular to fetch weather data for each user
     * Added dump functions to log in the proceedings
     */
    static function findWeatherOfAllUsers(){
        dump('findWeatherOfAllUsers Called');
        $users = User::all();
        $apiKey = env('WEATHER_API_KEY');
        $baseURL = env('WEATHER_API_BASE_URL');
        dump($apiKey);
        dump($baseURL);
        if($apiKey && $baseURL){
            foreach($users as $user){
                $response = Http::get("{$baseURL}/data/2.5/weather?lat={$user->latitude}&lon={$user->longitude}&units=metric&appid={$apiKey}");
                $user->weather = $response->json();
                $user->last_weather_updated = Carbon::now();
                $user->save();
                dump($user->id);
            }
            return true;
        }else{
            dump('No ENV variables found');
            throw new \Exception('No ENV variables found');
        }

    }
}
