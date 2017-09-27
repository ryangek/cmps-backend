<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

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
            'locate_name' => $data['locate_name'],
            'locate_floor' => $data['locate_floor'],
            'locate_image' => $data['locate_image']
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
        //$path = $request->file('locate_image')->store('avatars');
        $file = file_get_contents($request->input('locate_image'));
        //$save = file_put_contents('ryangek.png', base64_decode($file));
        //$data = $request->input('locate_image');
        //$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
        //$save = file_put_contents('ryangek.png', $data);
        //$save =file_put_contents('img.png', base64_decode($data));

        $save = file_put_contents('image.jpg', $file);
        return response()->json(['message' => $save], 200);
        /*if(!$this->createLocation($request->all())){
            return response()->json(['error' => 'Cannot add Location'], 404);
        }
        return response()->json(['Location' => $request->all()], 200);*/
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
        $data = json_decode($request->getContent(), true);
        $Location = Location::where('locate_id', $id)->get();
        if(!$Location){
            return response()->json(['error' => 'No location to update'], 404);
        }
        Location::where('locate_id', $id)
            ->update([
                'locate_name' => $request->input('locate_name'),
                'locate_floor' => $request->input('locate_floor'),
                'locate_quantity' => $request->input('locate_quantity')
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

    /**
     * Edited the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function quantityLocation(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        Location::where('locate_id', $data['locate_id'])
                ->update(['locate_quantity' => $data['locate_quantity'],
                        'updated_at' => date("Y-m-d H:i:s")]);
         if(!$data){
            return response()->json(['message' => 'Didn\'t updated location'], 404);
        }
        return response()->json($data, 200);
    }
}
