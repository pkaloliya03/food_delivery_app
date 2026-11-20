<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Search active cities
     */
    public function search(Request $request)
    {
        $search = trim($request->search ?? '');

        $cities = City::where('status', true)
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'name',
                        'like',
                        "%{$search}%"
                    )
                        ->orWhere(
                            'state',
                            'like',
                            "%{$search}%"
                        );
                });
            })
            ->orderBy('name')
            ->limit(20)
            ->get([
                'id',
                'name',
                'state',
            ]);

        return response()->json($cities);
    }


    /**
     * Select delivery city
     */
    public function select(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:master_cities,id',
        ]);

        $city = City::where('id', $request->city_id)
            ->where('status', true)
            ->firstOrFail();

        session([
            'selected_city_id' => $city->id,
            'selected_city_name' => $city->name,
            'selected_city_state' => $city->state,
        ]);

        return response()->json([
            'success' => true,
            'city' => [
                'id' => $city->id,
                'name' => $city->name,
                'state' => $city->state,
            ],
        ]);
    }
}
