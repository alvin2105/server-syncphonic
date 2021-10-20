<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'telp_number' => 'required',
            'address' => 'required'

        ]);

        return User::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->has('password') ? $request->all() : $request->except(['password']));
        if ($request->has('password'))
        {
            User::where('id', $id)->update(array('password' => bcrypt($request->input('password'))));
        }
        $response = [
			'message'=>'Update Succesfully',
            'User' => $user,
        ];

        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }

    /**
     * Search for a name
     *
     * @param  str  $nama_User
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return User::where('nama_User', 'like', '%'.$name.'%')->get();
    }

    /**
     * tampilakn semua user
     *
     * @param  str  $nama_User
     * @return \Illuminate\Http\Response
     */
    public function userAll()
    {
        return User::all();
    }
}