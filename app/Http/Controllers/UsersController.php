<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource. // get user list GET
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Users::all();
    }

    /**
     * Show the form for creating a new resource. // show form for create user GET
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage. // create user POST
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        $users = Users::create([
            "name" => $request->name,
            "email" => $request->email
        ]);

        return [
            "status" => true,
            "users" => $users
        ];

    }

    /**
     * Display the specified resource. // get user by id GET
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $users = Users::find($id);
        if(!$users) {
            return response()->json([
                "status" => false,
                "message" => "User not found"
            ])->setStatusCode(code: 404);
        }
        return $users;
    }

    /**
     * Show the form for editing the specified resource. // show form for edit user GET
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage. // update user PATCH
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage. // delete user DELETE
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
