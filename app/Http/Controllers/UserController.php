<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name" => ["required"],
                "email" => ["required"]
            ]
        );

        if($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email
        ]);

        return [
            "status" => true,
            "user" => $user
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(!$user) {
            return response()->json([
                "status" => false,
                "message" => "User not found"
            ])->setStatusCode(code: 404);
        }
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validator = Validator::make(
            $request->all(),
            [
                "name" => ["required"],
                "email" => ["required"]
            ]
        );

        if($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        $user = User::where('id', $id)->update([
            "name" => $request->name,
            "email" => $request->email
        ]);
        
        return [
            "status" => true,
            "user" => $user
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
