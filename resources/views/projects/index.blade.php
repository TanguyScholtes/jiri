@extends( 'layout' )

@section( 'title' )
    Projets
@stop

@section( 'content' )

    <h1>Projets</h2>
    @if( $projects )
        <ul>
            @foreach( $projects as $project )
                <li><a href="{{ route('projects.show', $project -> id) }}">{{ $project -> name }}</a></li>
            @endforeach
        </ul>
    @else
        <p>Il n'y a aucun projet à afficher.</p>
    @endif

@stop
