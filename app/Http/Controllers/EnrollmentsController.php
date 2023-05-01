<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollments;
use Validator;
use Carbon\Carbon;

class EnrollmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $query = Enrollments::select('enrollments.id', 'users.name', 'users.email', 'courses.title', 'enrollments.status', 'enrollments.created_at', 'enrollments.updated_at')
        ->join('courses', 'enrollments.courses_id', '=', 'courses.id')
        ->join('users', 'enrollments.user_id', '=', 'users.id');

        if ($request->has('searchCourse') && !empty($request->searchCourse)) {
            $query->where('courses.title', 'LIKE', '%' . $request->searchCourse . '%');
        }
        
        if ($request->has('searchUser') && !empty($request->searchUser)) {
            $query->where('users.name', 'LIKE', '%' . $request->searchUser . '%')
                  ->orWhere('users.email', 'LIKE', '%' . $request->searchUser . '%');
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', (new Enrollments())::STATUS[$request->status]);
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

        $enrollments = $query->latest()->paginate(20);
        return $enrollments;

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
