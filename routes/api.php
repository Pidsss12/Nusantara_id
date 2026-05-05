<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/provinces/{id}/destinations', function ($id) {
    // Return sample data for now if DB is empty, or fetch from DB
    $destinations = DB::table('destinations')->where('province_id', $id)->get();
    
    // Fallback Mock Data for demo if empty (since I haven't seeded destinations yet)
    if ($destinations->isEmpty()) {
        if ($id <= 6) { // Mock for Sumatera/Jawa
             return response()->json([
                [
                    'id' => 1,
                    'name' => 'Wisata Alam Mockup ' . $id,
                    'description' => 'Contoh destinasi indah di provinsi ini.',
                    'price' => 500000,
                    'photo' => 'https://source.unsplash.com/400x300/?nature,forest'
                ]
            ]);
        }
    }

    return response()->json($destinations);
});
