@extends( 'layout' )

@section( 'title' )
    Étudiants
@stop

@section( 'content' )

    <h1>Étudiants</h2>
    @if( $students )
        <ul>
            @foreach( $students as $student )
                <li><a href="{{ route('students.show', $student -> id) }}">{{ $student -> name }}</a></li>
            @endforeach
        </ul>
    @else
        <p>Il n'y a aucun étudiant à afficher.</p>
    @endif

@stop
