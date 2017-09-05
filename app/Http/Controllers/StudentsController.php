<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Jiri\Student;
use Jiri\Implementation;
use Jiri\Performance;
use App\User;
use Jiri\Meeting;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view( 'students.index', compact( 'students' ) );
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
    public function store(  )
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Student $student )
    {
        $user = Auth::user();
        $implementations = Implementation::with( 'project', 'event', 'scores' ) -> where( 'student_id', $student -> id ) -> get();
        $meetings = Meeting::with( 'user', 'event', 'scores' ) -> where( 'student_id', $student -> id ) -> get();

        return view( 'students.show', compact( 'user', 'student', 'meetings', 'implementations' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(  )
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(  )
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(  )
    {

    }

    public function delete(  ) {

    }
}
