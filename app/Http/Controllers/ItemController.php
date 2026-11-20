<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::where('owner_id', Auth::id())
            ->where('status', true)
            ->orderBy('name')
            ->get();

        $categories = Category::where('status', true)
            ->orderBy('name')
            ->get();

        $items = Item::with(['restaurant', 'category'])
            ->whereHas('restaurant', function ($query) {
                $query->where('owner_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('owner.items', compact(
            'items',
            'restaurants',
            'categories'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:master_restaurants,id',
            'category_id' => 'required|exists:master_categories,id',
            'name' => 'required|string|max:150',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'is_veg' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ]);

        // Make sure selected restaurant belongs to logged-in owner
        $restaurant = Restaurant::where('id', $request->restaurant_id)
            ->where('owner_id', Auth::id())
            ->where('status', true)
            ->first();

        if (!$restaurant) {
            return back()
                ->withInput()
                ->with('error', 'Selected restaurant is not available.');
        }

        // Make sure selected category is active
        $categoryExists = Category::where('id', $request->category_id)
            ->where('status', true)
            ->exists();

        if (!$categoryExists) {
            return back()
                ->withInput()
                ->with('error', 'Selected category is not available.');
        }

        $validated['is_veg'] = $request->boolean('is_veg');
        $validated['status'] = $request->boolean('status', true);

        $item = Item::create($validated);

        // Upload item image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();

            $path = $file->storeAs(
                'items/' . $item->id,
                $filename,
                'public'
            );

            $item->update([
                'image' => $path,
            ]);
        }

        return redirect()
            ->route('owner.items.index')
            ->with('success', 'Food item created successfully.');
    }

    public function update(Request $request, $id)
    {
        $item = Item::where('id', $id)
            ->whereHas('restaurant', function ($query) {
                $query->where('owner_id', Auth::id());
            })
            ->firstOrFail();

        $validated = $request->validate([
            'restaurant_id' => 'required|exists:master_restaurants,id',
            'category_id' => 'required|exists:master_categories,id',
            'name' => 'required|string|max:150',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'is_veg' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ]);

        // Make sure selected restaurant belongs to logged-in owner
        $restaurant = Restaurant::where('id', $request->restaurant_id)
            ->where('owner_id', Auth::id())
            ->where('status', true)
            ->first();

        if (!$restaurant) {
            return back()
                ->withInput()
                ->with('error', 'Selected restaurant is not available.');
        }

        // Make sure selected category is active
        $categoryExists = Category::where('id', $request->category_id)
            ->where('status', true)
            ->exists();

        if (!$categoryExists) {
            return back()
                ->withInput()
                ->with('error', 'Selected category is not available.');
        }

        $validated['is_veg'] = $request->boolean('is_veg');
        $validated['status'] = $request->boolean('status', true);

        $item->update($validated);

        // Replace image if new image uploaded
        if ($request->hasFile('image')) {

            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }

            $file = $request->file('image');
            $filename = $file->getClientOriginalName();

            $path = $file->storeAs(
                'items/' . $item->id,
                $filename,
                'public'
            );

            $item->update([
                'image' => $path,
            ]);
        }

        return redirect()
            ->route('owner.items.index')
            ->with('success', 'Food item updated successfully.');
    }

    public function destroy($id)
    {
        $item = Item::where('id', $id)
            ->whereHas('restaurant', function ($query) {
                $query->where('owner_id', Auth::id());
            })
            ->firstOrFail();

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()
            ->route('owner.items.index')
            ->with('success', 'Food item deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $item = Item::where('id', $id)
            ->whereHas('restaurant', function ($query) {
                $query->where('owner_id', Auth::id());
            })
            ->firstOrFail();

        $item->update([
            'status' => !$item->status,
        ]);

        return redirect()
            ->route('owner.items.index')
            ->with(
                'success',
                $item->status
                    ? 'Food item activated successfully.'
                    : 'Food item deactivated successfully.'
            );
    }
}
