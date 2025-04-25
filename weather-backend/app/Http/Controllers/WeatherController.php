<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $lat = $request->query('lat');
        $lon = $request->query('lon');
        $units = $request->query('units', 'metric'); // default to Celsius
        $apiKey = env('OPENWEATHER_API_KEY');

        if (!$lat || !$lon) {
            return response()->json(['error' => 'Latitude and longitude are required'], 400);
        }

        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'lat' => $lat,
            'lon' => $lon,
            'appid' => $apiKey,
            'units' => $units,
        ]);

        return response()->json($response->json());
    }
}
