<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

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
            'email' => $data['email'],
            'api_token' => str_random(60),
            'password' => bcrypt($data['password']),
            'status' => 'member',
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
        return response()->json(['users' => $users], 200);
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
        $user->name = $request->input('name');
        $user->email = $request->input('email');
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
        return response()->json(['message' => 'Member '.$id.' has been deleted'], 200);
    }
}
