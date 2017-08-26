<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function createLocation(array $data)
    {
        return Location::create([
            'locate_name' => $data['locateName'],
            'locate_floor' => $data['locateFloor'],
            'locate_quantity' => $data['locateQuantity']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLocation(Request $request)
    {
        if(!$this->createLocation($request->all())){
            return response()->json(['error' => 'Cannot add Location'], 404);
        }
        return response()->json(['Location' => $request->all()], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showLocation($id) //show
    {
        $Location = Location::where('locate_id', $id)->get();
        if(!$Location){
            return response()->json(['error' => 'Location '.$id.' not found'], 404);
        }
        return response()->json(['Location' => $Location], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editLocation($id)
    {
        $Location = Location::where('locate_id', $id)->get();
        if(!$Location){
            return response()->json(['error' => 'Location '.$id.' not found'], 404);
        }
        return response()->json(['Location' => $Location], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showLocationAll()
    {
        $Location = Location::all();
        return response()->json(['LocationAll' => $Location], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLocation(Request $request, $id)
    {
        $Location = Location::where('locate_id', $id)->get();
        if(!$Location){
            return response()->json(['error' => 'No location to update'], 404);
        }
        Location::where('locate_id', $id)
            ->update([
                'locate_name' => $request->input('locateName'),
                'locate_floor' => $request->input('locateFloor'),
                'locate_quantity' => $request->input('locateQuantity')
            ]);
        return response()->json(['Location' => Location::where('locate_id', $id)->get()], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyLocation($id)
    {
        $Location = Location::where('locate_id', $id);
        if(!$Location->delete()){
            return response()->json(['message' => 'Cannot deleted '.$id], 404);
        }
        return response()->json(['message' => 'Location '.$id.' has been deleted'], 200);
    }
}
