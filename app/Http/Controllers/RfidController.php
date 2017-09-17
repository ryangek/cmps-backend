<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rfid;

class RfidController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function createRfid(array $data)
    {
        return Rfid::create([
            'rfid_data' => $data['rfid_data']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRfid(Request $request)
    {
        $Rfid = Rfid::where('rfid_data', $request->input('rfid_data'))->get();
        if ($Rfid !== []) {
            if(!$this->createRfid($request->all())){
                return 0;
            }
            return 1;
        }
        return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRfid($id) //show
    {
        $Rfid = Rfid::where('rfid', $id)->get();
        if(!$Rfid){
            return response()->json(['error' => 'Rfid '.$id.' not found'], 404);
        }
        return response()->json(['Rfid' => $Rfid], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRfidAll()
    {
        $Rfid = Rfid::all();
        return response()->json(['RfidAll' => $Rfid], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRfid(Request $request, $id)
    {

        $Rfid = Rfid::where('rfid', $id)->get();
        if(!$Rfid){
            return response()->json(['error' => 'No member to update'], 404);
        }
        Rfid::where('rfid', $id)
            ->update([
                'rfid_user' => $request->input('rfid_user'),
                'rfid_fixed' => $request->input('rfid_fixed')
            ]);
        return response()->json(['Rfid' => $Rfid], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyRfid($id)
    {
        $Rfid = Rfid::where('rfid', $id);
        if(!$Rfid->delete()){
            return response()->json(['message' => 'Cannot deleted '.$id], 404);
        }
        return response()->json(['message' => 'Rfid '.$id.' has been deleted'], 200);
    }
}
