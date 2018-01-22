<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rfid;
use App\History;
use App\User;
use App\Device;

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
        $this->validate($request, array(
            'rfid_data' => 'unique:rfid'
        ));
        $Rfid = Rfid::where('rfid_data', $request->input('rfid_data'))->get();
        if(!$Rfid){
            return 0;
        }
        if ($Rfid !== []) {
            if(!$this->createRfid($request->all())){
                return 0;
            }
            event(new \App\Events\EventRfid());
            return 1;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRfidData(Request $request, $device) //show
    {
        $Rfid = Rfid::where('rfid_data', $request->input('rfid_data'))->get();
        if(!$Rfid){
            return 0;
        }
        if(count($Rfid)>0){
            if ($Rfid[0]->rfid_user != null) {
            	$user = User::where('id', $Rfid[0]->rfid_user)->get();
    	        $device_data = Device::where('device_id', $device)->get();
    	        History::create([
    	            'username' => $user[0]->username,
    	            'device' => $device,
    	            'location' => $device_data[0]->locate_id
    	        ]);    	
            	event(new \App\Events\EventHistory());
    	        return 1;
            }
            return 0;
        }
        return 0;
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
        $data = [];
        foreach ($Rfid as $key) {
            if ($key->rfid_user != null)
                $key->rfid_user = User::where('id', $key->rfid_user)->get()[0]->name;
            $data[] = $key;
        }
        return response()->json(['Rfid' => $data], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        event(new \App\Events\EventRfid());
        $rfid = Rfid::all();
        foreach ($rfid as $key) {
            echo $key['rfid'].': '.$key['rfid_data'].' <br/>';
        }
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

    public function showRfidNoUser() {
        $Rfid = Rfid::whereNull('rfid_user')->get();
        return response()->json(['Rfid' => $Rfid], 200);
    }
    public function showRfidNoDevice() {
        $Rfid = Rfid::whereNull('rfid_fixed')->get();
        return response()->json(['Rfid' => $Rfid], 200);
    }
    public function showRfidAdUser() {
        $Rfid = Rfid::whereNotNull('rfid_user')->get();
        return response()->json(['Rfid' => $Rfid], 200);
    }
    public function showRfidAdDevice() {
        $Rfid = Rfid::whereNotNull('rfid_fixed')->get();
        return response()->json(['Rfid' => $Rfid], 200);
    }
}
