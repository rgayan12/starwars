<?php

namespace App\Http\Controllers;

use App\Models\Spaceship;
use Illuminate\Http\Request;

class SpaceshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Spaceship::select('id', 'name', 'status')->filterByRequest($request)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validator($request);
        $spaceship = Spaceship::create($validatedData);
        $spaceship->armaments()->attach($validatedData['armaments'] ?? []);

        return response()->json(['success' => true], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $spaceship = Spaceship::select('id', 'name', 'class', 'crew', 'image', 'value', 'status')
            ->with('armaments:title')
            ->where('id', $id)
            ->first();

        //Data Manipulation
        foreach ($spaceship->armaments as $armament) {
            //Get the quantity from pivot table and append that to armaments
            $armament->qty = $armament->pivot->qty ?? null;
            unset($armament->pivot);
        }

        return $spaceship;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $this->validator($request);
        $spaceship = Spaceship::find($id);
        $spaceship->update($validatedData);

        return response()->json(['success' => true], 200);
    }

    public function validator($request)
    {
        return $request->validate([
            'name' => 'required|max:255',
            'class' => 'required|max:255',
            'crew' => 'required|numeric',
            'image' => 'nullable|url',
            'value' => 'required|numeric',
            'status' => 'in:Operational,Damaged',
            'armaments.*.armament_id' => 'exists:armaments,id',
            'armaments.*.qty' => 'required_with:armaments.*.armament_id'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spaceship = Spaceship::find($id);
        $spaceship->armaments()->detach();
        $spaceship->delete($spaceship);

        return response()->json(['success' => true], 200);
    }
}
