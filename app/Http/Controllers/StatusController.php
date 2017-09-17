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
            'stat_switch' => $data['stat_switch'],
            'stat_ultra' => $data['stat_ultra'],
            'stat_device' => $data['stat_device']
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
            return 0;
        }
        return 1;
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
        $Status->stat_switch = $request->input('stat_switch');
        $Status->stat_ultra = $request->input('stat_ultra');
        $Status->stat_device = $request->input('stat_device');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showStatusAdded()
    {
        $Status = DB::table('status')
            ->join('device', 'status.status_device', '=', 'device.device_id')
            ->select('status.*', 'device.*')
            ->where('device.device_status','yes')
            ->get();
        return response()->json(['StatusAll' => $Status], 200);
    }


}
