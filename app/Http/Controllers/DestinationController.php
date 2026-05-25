<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Province; // Pastikan model Province kamu di-import jika ada
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    // Halaman publik wisata/destinasi.
    public function index(Request $request)
    {
        $query = Destination::with('province')->where('status', 'Active');

        if ($request->filled('search') || $request->filled('q')) {
            $search = $request->input('search', $request->input('q'));
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($request->filled('province_id')) {
            $query->where('province_id', $request->province_id);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $destinations = $query
            ->orderBy('rating', 'desc')
            ->orderBy('name')
            ->get();

        return view('destinations.index', compact('destinations'));
    }

    // Method untuk menyimpan Destinasi Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'province_id' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'location' => 'required',
            'description' => 'required',
            'occupied_seats' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['rating'] = 5.0; // Default rating awal
        $data['status'] = 'Active';

        // Bersihkan spasi pada input kursi terisi (misal "2, 4" jadi "2,4")
        if ($request->filled('occupied_seats')) {
            $data['occupied_seats'] = str_replace(' ', '', $request->occupied_seats);
        }

        // Proses upload foto jika ada
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/destinations'), $filename);
            $data['photo'] = 'uploads/destinations/' . $filename;
        }

        Destination::create($data);

        return redirect()->back()->with('success', 'Destination created successfully!');
    }

    // Method untuk update data lama (Tempat kamu edit kursi terisi)
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'province_id' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'location' => 'required',
            'description' => 'required',
            'occupied_seats' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $destination = Destination::findOrFail($id);
        $data = $request->all();

        // Bersihkan spasi pada input nomor kursi
        if ($request->has('occupied_seats')) {
            $data['occupied_seats'] = str_replace(' ', '', $request->occupied_seats);
        }

        // Proses update foto baru jika diunggah
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($destination->photo && file_exists(public_path($destination->photo))) {
                @unlink(public_path($destination->photo));
            }
            
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/destinations'), $filename);
            $data['photo'] = 'uploads/destinations/' . $filename;
        }

        $destination->update($data);

        return redirect()->back()->with('success', 'Destination updated successfully!');
    }

    // Method untuk menghapus Destinasi (Dipicu oleh tombol SweetAlert-mu)
    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        
        if ($destination->photo && file_exists(public_path($destination->photo))) {
            @unlink(public_path($destination->photo));
        }

        $destination->delete();

        return redirect()->back()->with('success', 'Destination deleted successfully!');
    }

    // Method view detail untuk user-facing (Sisi depan aplikasi web)
    public function show($id)
    {
        $destination = Destination::with('province')->findOrFail($id);
        return view('destinations.show', compact('destination'));
    }
}
