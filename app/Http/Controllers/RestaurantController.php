<?php

namespace App\Http\Controllers;

use App\Http\Resources\RestaurantResrouce;
use App\Models\Restaurant;
use App\Services\DistanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function index(Request $request) {
        $data = $request->validate([
            "category" => ['nullable', 'exists:categories,id'],
            "open" => ["nullable", "boolean"],
            "latitude" => ["nullable", "integer"],
            "longitude" => ["nullable", "integer"]
        ]);
        $now = Carbon::now();
        $today = $now->dayName;
        $query = Restaurant::query()
        ->with("category")
        ->leftJoin('open_times', 'day', '=', DB::raw("'$today'"));
        $time = $now->format('H:i:s');
        if(array_key_exists('open', $data)) {
            $query->where("open_times.open", $data['open'])
                ->where('start_time', '<=', $time)
                ->where('end_time', '>=', $time);
        }
        if(array_key_exists("category", $data)) {
            $query->whereCategoryId($data["category"]);
        }
        $restaurants = $query->get();
        $restaurants = $restaurants->map(function ($restaurant) use ($time) {
            $restaurant['openState'] = $restaurant['open'];
            if(!(Carbon::create($restaurant["start_time"]) <= $time && Carbon::create($restaurant["end_time"]) >= $time)) {
                $restaurant['openState'] = false;
            }
            return $restaurant;
        });
        if(key_exists('latitude', $data) && key_exists('longitude', $data)) {
            $restaurants = $restaurants->sort(function ($a, $b) {
                $distance = DistanceService::getDistanceFromLatLonInKm($a['latitude'], $a['longitude'], $b['latitude'], $b['longitude']);
                return $distance;
            });
        }
        return RestaurantResrouce::collection($restaurants);
    }

    public function single(Restaurant $restaurant, Request $request) {
        return new RestaurantResrouce($restaurant);
    }
}
