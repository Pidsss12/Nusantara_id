<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Destination;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::with('destination');
        
        // Filter by search
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        // Filter by destination
        if ($request->destination_id) {
            $query->where('destination_id', $request->destination_id);
        }
        
        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        $packages = $query->orderBy('id', 'desc')->paginate(9);
        $destinations = Destination::where('status', 'Active')->get();
        
        return view('admin.packages', compact('packages', 'destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'destination_id' => 'required|exists:destinations,id',
            'duration' => 'required|string',
            'price' => 'required|numeric',
            'max_participants' => 'required|integer',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/packages'), $filename);
            $data['image'] = 'uploads/packages/' . $filename;
        }

        Package::create($data);

        return redirect()->route('admin.packages')->with('success', 'Package created successfully!');
    }

    public function show(Package $package)
    {
        $package->load(['destination', 'bookings']);
        return response()->json($package);
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'destination_id' => 'required|exists:destinations,id',
            'duration' => 'required|string',
            'price' => 'required|numeric',
            'max_participants' => 'required|integer',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/packages'), $filename);
            $data['image'] = 'uploads/packages/' . $filename;
        }

        $package->update($data);

        return redirect()->route('admin.packages')->with('success', 'Package updated successfully!');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.packages')->with('success', 'Package deleted successfully!');
    }
}
