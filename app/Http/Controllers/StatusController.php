<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Status;

class StatusController extends Controller
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
    private function createStatus(array $data)
    {
        return Status::create([
            'stat_motor' => $data['statMotor'],
            'stat_switch' => $data['statSwitch'],
            'stat_ultra' => $data['statUltra'],
            'stat_device' => $data['statDevice']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStatus(Request $request)
    {
        if(!$this->createStatus($request->all())){
            return response()->json(['error' => 'Cannot add status'], 404);
        }
        return response()->json(['Status' => $request->all()], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showStatus($id) //show
    {
        $Status = Status::find($id);
        if(!$Status){
            return response()->json(['error' => 'Status '.$id.' not found'], 404);
        }
        return response()->json(['Status' => $Status], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editStatus($id)
    {
        $Status = Status::find($id);
        if(!$Status){
            return response()->json(['error' => 'Status '.$id.' not found'], 404);
        }
        return response()->json(['Status' => $Status], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showStatusAll()
    {
        $Status = Status::all();
        return response()->json(['StatusAll' => $Status], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {

        $Status = Status::find($id);
        if(!$Status){
            return response()->json(['error' => 'No member to update'], 404);
        }
        $Status->stat_motor = $request->input('statMotor');
        $Status->stat_switch = $request->input('statSwitch');
        $Status->stat_ultra = $request->input('statUltra');
        $Status->stat_device = $request->input('statDevice');
        $Status->save();
        return response()->json(['Status' => $Status], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyStatus($id)
    {
        $Status = Status::find($id);
        if(!$Status->delete()){
            return response()->json(['message' => 'Cannot deleted '.$id], 404);
        }
        return response()->json(['message' => 'Member '.$id.' has been deleted'], 200);
    }
}
