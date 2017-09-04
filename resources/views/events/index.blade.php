@extends( 'layout' )

@section( 'title' )
    Épreuves
@stop

@section( 'content' )

    <h1>Épreuves</h2>
    @if( $events )
        <ul>
            @foreach( $events as $event )
                <li><a href="{{ route('events.show', $event -> id) }}">{{ $event -> course_name }} ({{ $event -> academic_year }})</a></li>
            @endforeach
        </ul>
    @else
        <p>Il n'y a aucun évènement à afficher.</p>
    @endif

@stop
