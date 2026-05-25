<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::with('province');
        
        // Filter by search
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        // Filter by province
        if ($request->province_id) {
            $query->where('province_id', $request->province_id);
        }
        
        // Filter by category
        if ($request->category) {
            $query->where('category', $request->category);
        }
        
        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        $destinations = $query->orderBy('id', 'desc')->paginate(10);
        $provinces = Province::all();
        $categories = ['Marine', 'Mountain', 'Wildlife', 'Heritage', 'Beach', 'Lake', 'Nature'];
        
        return view('admin.destinations', compact('destinations', 'provinces', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
            'category' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string',
            'quota_per_day' => 'nullable|integer|min:1',
            'unavailable_hotels' => 'nullable|array',
            'unavailable_hotels.*' => 'string',
            'unavailable_restaurants' => 'nullable|array',
            'unavailable_restaurants.*' => 'string',
            'unavailable_menus' => 'nullable|array',
            'unavailable_menus.*' => 'string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['unavailable_hotels'] = $request->input('unavailable_hotels', []);
        $data['unavailable_restaurants'] = $request->input('unavailable_restaurants', []);
        $data['unavailable_menus'] = $request->input('unavailable_menus', []);
        
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/destinations'), $filename);
            $data['photo'] = 'uploads/destinations/' . $filename;
        }

        Destination::create($data);

        return redirect()->route('admin.destinations')->with('success', 'Destination created successfully!');
    }

    public function show(Destination $destination)
    {
        $destination->load(['province', 'packages', 'bookings']);
        return view('admin.destinations.show', compact('destination'));
    }

    public function edit(Destination $destination)
    {
        $provinces = Province::all();
        $categories = ['Marine', 'Mountain', 'Wildlife', 'Heritage', 'Beach', 'Lake', 'Nature'];
        return view('admin.destinations.edit', compact('destination', 'provinces', 'categories'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
            'category' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string',
            'status' => 'required|in:Active,Inactive',
            'quota_per_day' => 'nullable|integer|min:1',
            'unavailable_hotels' => 'nullable|array',
            'unavailable_hotels.*' => 'string',
            'unavailable_restaurants' => 'nullable|array',
            'unavailable_restaurants.*' => 'string',
            'unavailable_menus' => 'nullable|array',
            'unavailable_menus.*' => 'string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['unavailable_hotels'] = $request->input('unavailable_hotels', []);
        $data['unavailable_restaurants'] = $request->input('unavailable_restaurants', []);
        $data['unavailable_menus'] = $request->input('unavailable_menus', []);
        
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/destinations'), $filename);
            $data['photo'] = 'uploads/destinations/' . $filename;
        }

        $destination->update($data);

        return redirect()->route('admin.destinations')->with('success', 'Destination updated successfully!');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('admin.destinations')->with('success', 'Destination deleted successfully!');
    }
}
