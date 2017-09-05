<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jiri\Event;
use App\User;
use Jiri\Weight;
use Jiri\Project;
use Jiri\Meeting;
use Jiri\Implementation;
use Jiri\Student;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view( 'events.index', compact( 'events' ) );
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
    public function show( Event $event )
    {
        $owner = User::where( 'id', $event -> user_id )-> first();
        $projects = DB::table( 'projects' ) -> join( 'weights', 'projects.id', '=', 'weights.project_id' ) -> where( 'event_id', $event -> id ) -> get();
        $meetings = Meeting::with( 'student', 'user', 'scores' ) -> where( 'event_id', $event -> id ) -> get();
        $implementations = Implementation::with( 'project', 'student', 'scores' ) -> where( 'event_id', $event -> id ) -> get();
        $users = [];
        foreach ( $meetings as $meeting ) {
            if( !in_array( $meeting -> user, $users ) ) {
                $users[] = $meeting -> user;
            }
        }
        $students = [];
        foreach ( $meetings as $meeting ) {
            if( !in_array( $meeting -> student, $students ) ) {
                $students[] = $meeting -> student;
            }
        }


        return view( 'events.show', compact( 'event', 'owner', 'projects', 'meetings', 'implementations', 'students', 'users' ) );
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
