<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = Car::latest();

    if ($request->filled('q')) {
        $query->where(function ($q) use ($request) {
            $q->where('brand', 'like', '%' . $request->q . '%')
              ->orWhere('model', 'like', '%' . $request->q . '%')
              ->orWhere('year', 'like', '%' . $request->q . '%');
        });
    }

    $cars = $query->paginate(12);

    return view('cars.index', compact('cars'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'brand'        => 'required|string|max:100',
            'model'        => 'required|string|max:100',
            'year'         => 'required|integer|min:1990|max:' . date('Y'),
            'price'        => 'required|numeric|min:0',
            'mileage'      => 'required|integer|min:0',
            'transmission' => 'required|in:manual,matic',
            'fuel_type'    => 'required|in:bensin,diesel,listrik,hybrid',
            'description'  => 'nullable|string',
            'image' => 'nullable|url',
        ]);

        // if ($request->hasFile('image')) {
        //     $validated['image'] = $request->file('image')->store('cars', 'public');
        // }

        $validated['user_id'] = Auth::id();
        $validated['status']  = 'available';

        Car::create($validated);

        return redirect()->route('cars.index')->with('success', 'Mobil berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
         return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Car $car)
{
    if ($car->user_id !== Auth::id()) {
        abort(403, 'Kamu tidak punya akses ke halaman ini.');
    }
    return view('cars.edit', compact('car'));
}

public function update(Request $request, Car $car)
{
    if ($car->user_id !== Auth::id()) {
        abort(403, 'Kamu tidak punya akses ke halaman ini.');
    }

    $validated = $request->validate([
        'brand'        => 'required|string|max:100',
        'model'        => 'required|string|max:100',
        'year'         => 'required|integer|min:1990|max:' . date('Y'),
        'price'        => 'required|numeric|min:0',
        'mileage'      => 'required|integer|min:0',
        'transmission' => 'required|in:manual,matic',
        'fuel_type'    => 'required|in:bensin,diesel,listrik,hybrid',
        'description'  => 'nullable|string',
        'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }
        $validated['image'] = $request->file('image')->store('cars', 'public');
    }

    $car->update($validated);

    return redirect()->route('cars.index')->with('success', 'Mobil berhasil diupdate!');
}

public function destroy(Car $car)
{
    if ($car->user_id !== Auth::id()) {
        abort(403, 'Kamu tidak punya akses ke halaman ini.');
    }

    if ($car->image) {
        Storage::disk('public')->delete($car->image);
    }

    $car->delete();

    return redirect()->route('cars.index')->with('success', 'Mobil berhasil dihapus!');
}
}
