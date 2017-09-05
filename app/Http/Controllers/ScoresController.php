<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Jiri\Score;
use Jiri\Implementation;
use App\User;
use Jiri\Meeting;
use Jiri\Project;

class ScoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores = Score::all();
        return view( 'scores.index', compact( 'scores' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
    public function show( Score $score )
    {
        $user = Auth::user();
        $implementation = Implementation::with( 'project', 'event', 'student' ) -> where( 'id', $score -> implementation_id ) -> first();
        $meeting = Meeting::with( 'event', 'student', 'user' ) -> where( [ 'student_id' => $implementation -> student -> id, 'event_id' => $implementation -> event -> id ] ) -> first();

        return view( 'scores.show', compact( 'user', 'score', 'implementation', 'meeting' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Score $score )
    {
        $user = Auth::user();
        $implementation = Implementation::with( 'project', 'event', 'student' ) -> where( 'id', $score -> implementation_id ) -> first();
        $meeting = Meeting::with( 'event', 'student', 'user' ) -> where( [ 'student_id' => $implementation -> student -> id, 'event_id' => $implementation -> event -> id ] ) -> first();
        $_SESSION[ 'score' ] = $score -> score;
        $_SESSION[ 'comment' ] = $score -> comment;

        return view( 'scores.show', compact( 'user', 'score', 'implementation', 'meeting' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Score $score )
    {
        if ( isset( $_POST[ 'scoreId' ] ) ) {
            $scoreId = intval( $_POST[ 'scoreId' ] );
            $score = Score::with( 'meeting', 'implementation' ) -> where( 'id', $scoreId );
            if ( $score ) {
                //get all values from $_POST and validate them
                if ( isset( $_POST[ 'score' ] ) ) {
                    $_SESSION[ 'score' ] = intval( $_POST[ 'score' ] );
                }
                if ( isset( $_POST[ 'comment' ] ) ) {
                    $_SESSION[ 'comment' ] = strval( $_POST[ 'comment' ] );
                }

                if ( isset( $errors ) ) {
                    //redirect to form
                } else {
                    //update in DB
                    DB::table( 'scores' ) -> where( 'id', $scoreId )
                        -> update( [ 'score' => $_SESSION[ 'score' ],
                                    'comment' => $_SESSION[ 'comment' ] ] );
                    //redirect to newly updated score
                    header( 'Location: ' . {{ route('scores.show', $scoreId ) }} );
                    die();
                }
            } else {
                    //error handling : score doesn't exist
            }
        } else {
            //error handling : no score id
        }
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
