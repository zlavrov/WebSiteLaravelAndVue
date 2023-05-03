<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Course::all();
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
        //
        $validator = Validator::make(
            $request->all(),
            [
                "title" => ["required"]
            ]
        );

        if($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        $course = Course::create([
            "title" => $request->title
        ]);

        return [
            "status" => true,
            "course" => $course
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
        $course = Course::find($id);
        if(!$course) {
            return response()->json([
                "status" => false,
                "message" => "Course not found"
            ])->setStatusCode(code: 404);
        }
        return $course;
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
                "title" => ["required"]
            ]
        );

        if($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        $course = Course::where('id', $id)->update([
            "title" => $request->title
        ]);
        
        return [
            "status" => true,
            "course" => $course
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
