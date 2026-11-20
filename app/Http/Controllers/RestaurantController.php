<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display all restaurants of logged-in owner.
     */
    public function index()
    {
        $restaurants = Restaurant::with('city')
            ->where('owner_id', Auth::id())
            ->latest()
            ->get();

        $cities = City::where('status', true)
            ->orderBy('name')
            ->get();

        return view('owner.restaurants', compact(
            'restaurants',
            'cities'
        ));
    }


    /**
     * Store a new restaurant.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'description' => 'nullable|string',
            'mobile' => 'nullable|string|max:20',
            'city_id' => 'required|exists:master_cities,id',
            'address' => 'nullable|string',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
            'status' => 'nullable|boolean',
        ]);

        $cityExists = City::where('id', $request->city_id)
            ->where('status', true)
            ->exists();

        if (!$cityExists) {
            return back()
                ->withInput()
                ->with('error', 'Selected city is not available.');
        }

        $validated['owner_id'] = Auth::id();
        $validated['status'] = $request->boolean('status', true);

        /*
    |--------------------------------------------------------------------------
    | Create Restaurant First
    |--------------------------------------------------------------------------
    */
        $restaurant = Restaurant::create($validated);

        /*
    |--------------------------------------------------------------------------
    | Upload Logo
    |--------------------------------------------------------------------------
    */
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs(
                'restaurants/logos/' . $restaurant->id,
                $filename,
                'public'
            );
            $restaurant->update([
                'logo' => $path
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | Upload Cover Image
    |--------------------------------------------------------------------------
    */
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs(
                'restaurants/covers/' . $restaurant->id,
                $filename,
                'public'
            );
            $restaurant->update([
                'cover_image' => $path
            ]);
        }

        return redirect()
            ->route('owner.restaurants.index')
            ->with('success', 'Restaurant created successfully.');
    }


    /**
     * Update an existing restaurant.
     */
    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::where('id', $id)
            ->where('owner_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'description' => 'nullable|string',
            'mobile' => 'nullable|string|max:20',
            'city_id' => 'required|exists:master_cities,id',
            'address' => 'nullable|string',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
            'status' => 'nullable|boolean',
        ]);

        $cityExists = City::where('id', $request->city_id)
            ->where('status', true)
            ->exists();

        if (!$cityExists) {
            return back()
                ->withInput()
                ->with('error', 'Selected city is not available.');
        }

        $validated['status'] = $request->boolean('status', true);

        /*
    |--------------------------------------------------------------------------
    | Update Basic Information
    |--------------------------------------------------------------------------
    */
        $restaurant->update($validated);

        /*
    |--------------------------------------------------------------------------
    | Upload New Logo
    |--------------------------------------------------------------------------
    */
        if ($request->hasFile('logo')) {

            // Delete old logo
            if ($restaurant->logo) {
                Storage::disk('public')->delete($restaurant->logo);
            }
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs(
                'restaurants/logos/' . $restaurant->id,
                $filename,
                'public'
            );
            $restaurant->update([
                'logo' => $path
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | Upload New Cover Image
    |--------------------------------------------------------------------------
    */
        if ($request->hasFile('cover_image')) {

            // Delete old cover
            if ($restaurant->cover_image) {
                Storage::disk('public')->delete($restaurant->cover_image);
            }
            $file = $request->file('cover_image');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs(
                'restaurants/covers/' . $restaurant->id,
                $filename,
                'public'
            );
            $restaurant->update([
                'cover_image' => $path
            ]);
        }

        return redirect()
            ->route('owner.restaurants.index')
            ->with('success', 'Restaurant updated successfully.');
    }


    /**
     * Delete restaurant.
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::where('id', $id)
            ->where('owner_id', Auth::id())
            ->firstOrFail();

        /*
    |--------------------------------------------------------------------------
    | Delete Images
    |--------------------------------------------------------------------------
    */
        if ($restaurant->logo) {
            Storage::disk('public')->delete($restaurant->logo);
        }

        if ($restaurant->cover_image) {
            Storage::disk('public')->delete($restaurant->cover_image);
        }

        $restaurant->delete();

        return redirect()
            ->route('owner.restaurants.index')
            ->with('success', 'Restaurant deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $restaurant = Restaurant::where('id', $id)
            ->where('owner_id', Auth::id())
            ->firstOrFail();

        $restaurant->update([
            'status' => !$restaurant->status,
        ]);

        return redirect()
            ->route('owner.restaurants.index')
            ->with(
                'success',
                $restaurant->status
                    ? 'Restaurant activated successfully.'
                    : 'Restaurant deactivated successfully.'
            );
    }
}
