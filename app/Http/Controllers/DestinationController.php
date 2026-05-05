<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::where('status', 'Active')
            ->with('province')
            ->orderBy('rating', 'desc')
            ->get();
        
        return view('destinations.index', compact('destinations'));
    }

    public function show($id)
    {
        $destination = Destination::with('province')->findOrFail($id);
        
        return view('destinations.show', compact('destination'));
    }
}
