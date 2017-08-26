<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ParkSpace;

class ParkSpaceController extends Controller
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
    private function createParkSpace(array $data)
    {
        return ParkSpace::create([
            'park_name' => $data['parkName'],
            'park_locate' => $data['parkLocate']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeParkSpace(Request $request)
    {
        if(!$this->createParkSpace($request->all())){
            return response()->json(['error' => 'Cannot add ParkSpace'], 404);
        }
        return response()->json(['ParkSpace' => $request->all()], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showParkSpace($id) //show
    {
        $ParkSpace = ParkSpace::where('park_id', $id)->get();
        if(!$ParkSpace){
            return response()->json(['error' => 'ParkSpace '.$id.' not found'], 404);
        }
        return response()->json(['ParkSpace' => $ParkSpace], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editParkSpace($id)
    {
        $ParkSpace = ParkSpace::where('park_id', $id)->get();
        if(!$ParkSpace){
            return response()->json(['error' => 'ParkSpace '.$id.' not found'], 404);
        }
        return response()->json(['ParkSpace' => $ParkSpace], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showParkSpaceAll()
    {
        $ParkSpace = ParkSpace::all();
        return response()->json(['ParkSpaceAll' => $ParkSpace], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateParkSpace(Request $request, $id)
    {

        $ParkSpace = ParkSpace::where('park_id', $id)->get();
        if(!$ParkSpace){
            return response()->json(['error' => 'No member to update'], 404);
        }
        ParkSpace::where('park_id', $id)
            ->update([
                'park_name' => $request->input('parkName'),
                'park_locate' => $request->input('parkLocate')
            ]);
        return response()->json(['ParkSpace' => ParkSpace::where('park_id', $id)->get()], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyParkSpace($id)
    {
        $ParkSpace = ParkSpace::where('park_id', $id);
        if(!$ParkSpace->delete()){
            return response()->json(['message' => 'Cannot deleted '.$id], 404);
        }
        return response()->json(['message' => 'Member '.$id.' has been deleted'], 200);
    }
}
