@extends( 'layout' )

@section( 'title' )
    Jury
@stop

@section( 'content' )

    <h1>Jury</h2>
    @if( $users )
        <ul>
            @foreach( $users as $user )
                <li><a href="{{ route('users.show', $user -> id) }}">{{ $user -> name }}</a></li>
            @endforeach
        </ul>
    @else
        <p>Il n'y a aucun jury à afficher.</p>
    @endif

@stop
