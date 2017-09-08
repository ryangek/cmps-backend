<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Device;

class DeviceController extends Controller
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
    private function createDevice(array $data)
    {
        return Device::create([
            'device_name' => $data['deviceName'],
            'device_park' => $data['devicePark']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDevice(Request $request)
    {
        if(!$this->createDevice($request->all())){
            return response()->json(['error' => 'Cannot add Device'], 404);
        }
        return response()->json(['Device' => $request->all()], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDevice($id) //show
    {
        $Device = Device::where('device_id', $id)->get();
        if(!$Device){
            return response()->json(['error' => 'Device '.$id.' not found'], 404);
        }
        return response()->json(['Device' => $Device], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editDevice($id)
    {
        $Device = Device::where('device_id', $id)->get();
        if(!$Device){
            return response()->json(['error' => 'Device '.$id.' not found'], 404);
        }
        return response()->json(['Device' => $Device], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDeviceAll()
    {
        $Device = Device::all();
        return response()->json(['DeviceAll' => $Device], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDevice(Request $request, $id)
    {

        $Device = Device::where('device_id', $id)->get();
        if(!$Device){
            return response()->json(['error' => 'No member to update'], 404);
        }
        Device::where('device_id', $id)
            ->update([
                'device_name' => $request->input('deviceName'),
                'device_park' => $request->input('devicePark')
            ]);
        return response()->json(['Device' => $Device], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyDevice($id)
    {
        $Device = Device::where('device_id', $id);
        if(!$Device->delete()){
            return response()->json(['message' => 'Cannot deleted '.$id], 404);
        }
        return response()->json(['message' => 'Member '.$id.' has been deleted'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDevice()
    {
        $Device = Device::all()->pluck('device_name')->toArray();
        if(!$Device){
            return response()->json(['message' => 'Don\'t have any device'], 404);
        }
        return response()->json($Device, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAddedDevice()
    {
        $Device = Device::where('device_status', 'yes')->get()->toArray();
        if(!$Device){
            return response()->json(['message' => 'Don\'t have any device'], 404);
        }
        return response()->json($Device, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAvailiableDevice()
    {
        $Device = Device::where('device_status', 'no')->get()->toArray();
        if(!$Device){
            return response()->json(['message' => 'Don\'t have any device'], 404);
        }
        return response()->json($Device, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDeviceJson(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        foreach ($data as $d) {
            Device::where('device_id', $d['device_id'])
                ->update(['device_name' => $d['device_name'],
                        'device_status'=> $d['device_status'],
                        'device_top' => $d['device_top'],
                        'device_left' => $d['device_left'],
                        'updated_at' => date("Y-m-d H:i:s")]);
        }
        if(!$data){
            return response()->json(['message' => 'Don\'t updated any device'], 404);
        }
        return response()->json($data, 200);
    }
}
