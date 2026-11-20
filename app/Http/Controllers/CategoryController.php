<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display categories belonging to the logged-in owner's restaurants.
     */
    public function index()
    {
        $categories = Category::with('restaurant')
            ->whereHas('restaurant', function ($query) {
                $query->where('owner_id', Auth::id());
            })
            ->latest()
            ->get();

        $restaurants = Restaurant::where('owner_id', Auth::id())
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('owner.categories', compact(
            'categories',
            'restaurants'
        ));
    }

    /**
     * Store a new category.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => [
                'required',
                'integer',
                'exists:master_restaurants,id',
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Verify restaurant belongs to logged-in owner
        |--------------------------------------------------------------------------
        */

        $restaurant = Restaurant::where('id', $request->restaurant_id)
            ->where('owner_id', Auth::id())
            ->where('status', true)
            ->first();

        if (!$restaurant) {
            return back()
                ->withInput()
                ->with('error', 'Selected restaurant is not available.');
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent duplicate category name inside same restaurant
        |--------------------------------------------------------------------------
        */

        $categoryExists = Category::where('restaurant_id', $restaurant->id)
            ->where('name', $request->name)
            ->exists();

        if ($categoryExists) {
            return back()
                ->withInput()
                ->with('error', 'This category already exists in the selected restaurant.');
        }

        $validated['status'] = $request->boolean('status', true);
        $validated['sort_order'] = $request->input('sort_order', 0);

        Category::create($validated);

        return redirect()
            ->route('owner.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Update an existing category.
     */
    public function update(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | Find category only if it belongs to logged-in owner's restaurant
        |--------------------------------------------------------------------------
        */

        $category = Category::where('id', $id)
            ->whereHas('restaurant', function ($query) {
                $query->where('owner_id', Auth::id());
            })
            ->firstOrFail();

        $validated = $request->validate([
            'restaurant_id' => [
                'required',
                'integer',
                'exists:master_restaurants,id',
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Verify selected restaurant belongs to logged-in owner
        |--------------------------------------------------------------------------
        */

        $restaurant = Restaurant::where('id', $request->restaurant_id)
            ->where('owner_id', Auth::id())
            ->where('status', true)
            ->first();

        if (!$restaurant) {
            return back()
                ->withInput()
                ->with('error', 'Selected restaurant is not available.');
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent duplicate category name inside same restaurant
        |--------------------------------------------------------------------------
        */

        $categoryExists = Category::where('restaurant_id', $restaurant->id)
            ->where('name', $request->name)
            ->where('id', '!=', $category->id)
            ->exists();

        if ($categoryExists) {
            return back()
                ->withInput()
                ->with('error', 'This category already exists in the selected restaurant.');
        }

        $validated['status'] = $request->boolean('status', true);
        $validated['sort_order'] = $request->input('sort_order', 0);

        $category->update($validated);

        return redirect()
            ->route('owner.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Delete a category.
     */
    public function destroy($id)
    {
        /*
        |--------------------------------------------------------------------------
        | Delete only categories belonging to logged-in owner's restaurant
        |--------------------------------------------------------------------------
        */

        $category = Category::where('id', $id)
            ->whereHas('restaurant', function ($query) {
                $query->where('owner_id', Auth::id());
            })
            ->firstOrFail();

        $category->delete();

        return redirect()
            ->route('owner.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    /**
     * Toggle category active/inactive status.
     */
    public function toggleStatus($id)
    {
        $category = Category::where('id', $id)
            ->whereHas('restaurant', function ($query) {
                $query->where('owner_id', Auth::id());
            })
            ->firstOrFail();

        $category->update([
            'status' => !$category->status,
        ]);

        return redirect()
            ->route('owner.categories.index')
            ->with(
                'success',
                $category->status
                    ? 'Category activated successfully.'
                    : 'Category deactivated successfully.'
            );
    }
}
