@extends( 'layout' )

@section( 'title' )
    {{ $event -> course_name }} ({{ $event -> academic_year }})
@stop

@section( 'content' )

    <h1>{{ $event -> course_name }} ({{ $event -> academic_year }})</h1>

@stop
