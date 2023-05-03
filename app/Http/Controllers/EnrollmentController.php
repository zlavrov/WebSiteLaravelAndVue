<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $query = Enrollment::select('enrollments.id', 'users.name', 'users.email', 'courses.title', 'enrollments.status', 'enrollments.created_at', 'enrollments.updated_at')
        ->join('courses', 'enrollments.course_id', '=', 'courses.id')
        ->join('users', 'enrollments.user_id', '=', 'users.id');

        if ($request->has('searchCourse') && !empty($request->searchCourse)) {
            $query->where('courses.title', 'LIKE', '%' . $request->searchCourse . '%');
        }
        
        if ($request->has('searchUser') && !empty($request->searchUser)) {
            $query->where('users.name', 'LIKE', '%' . $request->searchUser . '%')
                  ->orWhere('users.email', 'LIKE', '%' . $request->searchUser . '%');
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', (new Enrollment())::STATUS[$request->status]);
        }

        if ($request->has('sortBy') && !empty($request->sortBy)) {
            if ($request->sortBy === 'date-created') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sortBy === 'date-completed') {
                $query->orderBy('updated_at', 'asc');
            } elseif ($request->sortBy === 'course-name') {
                $query->orderBy('title', 'asc');
            }
        }

        $enrollment = $query->latest()->paginate(20);
        return $enrollment;

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
                "user_id" => ["required"],
                "course_id" => ["required"],
                "status_now" => ["required"]
            ]
        );

        if($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        $enrollment = Enrollment::create([
            "user_id" => $request->user_id,
            "course_id" => $request->course_id,
            "status" => $request->status_now
        ]);

        return [
            "status" => true,
            "enrollment" => $enrollment
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
        //
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
        //
        $validator = Validator::make(
            $request->all(),
            [
                "changeStatus" => ["required"]
            ]
        );

        if($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        $enrollment = Enrollment::where('id', $id)->update([
            "status" => (new Enrollment())::STATUS[$request->changeStatus]
        ]);
        
        return [
            "status" => true,
            "enrollment" => $enrollment
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
        $enrollment = Enrollment::destroy([$id]);
        return [
            "status" => true,
            "enrollment" => $id
        ];
    }
}
