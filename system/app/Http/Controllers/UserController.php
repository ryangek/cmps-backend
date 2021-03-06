<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Rfid;

class UserController extends Controller
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
    private function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'api_token' => str_random(60),
            'password' => bcrypt($data['password']),
            'status' => 'member',
            'license' => $data['license'],
            'address_data' => $data['address'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        $data = User::where('email', $request->input('email'))->get()->toArray();
        if(count($data)>0)
            return response()->json(['error' => 'Email has already'], 404);
        if(!$this->createUser($request->all())){
           return response()->json(['error' => 'Cannot add member'], 404);
        }
        $user = User::where('email', $request->input('email'))->get();
        foreach ($user as $item) {
            $uid = $item['id'];
        }
        Rfid::where('rfid', $request->input('rfid'))
            ->update([
                'rfid_user' => $uid
            ]);
        return response()->json(['email' => $request->input('email')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUser($id) //show
    {
        $user = User::where([
            ['status','member'],
            ['id',$id]
        ])->get();
        if(!$user){
            return response()->json(['error' => 'Member '.$id.' not found'], 404);
        }
        return response()->json(['user' => $user], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['error' => 'Member '.$id.' not found'], 404);
        }
        return response()->json(['user' => $user], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserAll()
    { 
        $users = User::where('status','member')->get();
        $data = [];
        foreach ($users as $u) {
            $u->rfid = Rfid::where('rfid_user', $u->id)->get()[0]->rfid;
            $u->rfid_data = Rfid::where('rfid_user', $u->id)->get()[0]->rfid_data;
            $data[] = $u;
        }
        return response()->json(['users' => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['error' => 'No member to update'], 404);
        }
        $rfid = Rfid::where('rfid_user', $id)->get();
        if ($rfid[0]->rfid != $request->input('rfid')){
            Rfid::where('rfid_user', $id)->update(['rfid_user' => null]);
            Rfid::where('rfid', $rfid[0]->rfid)->update(['rfid_user' => $id]);
        }
        $user->name = $request->input('name');
        $user->license = $request->input('license');
        $user->address_data = $request->input('address');
        $user->save();
        return response()->json(['user' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUser($id)
    {
        $user = User::where([
            ['status','member'],
            ['id',$id]
        ]);
        if(!$user->delete()){
            return response()->json(['message' => 'Cannot deleted '.$id], 404);
        }
        Rfid::where('rfid_user', $id)
            ->update([
                'rfid_user' => ''
            ]);
        return response()->json(['message' => 'Member '.$id.' has been deleted'], 200);
    }
}
