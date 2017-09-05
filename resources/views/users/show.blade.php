@extends( 'layout' )

@section( 'title' )
    {{ $user -> name }}
@stop

@section( 'content' )

    <h1>{{ $user -> name }}</h1>
    <p>Employeur : {{ $user -> company }}</p>
    <p>Email : <a href="mailto:{{ $user -> email }}">{{ $user -> email }}</a></p>

    <h2>Rencontres :</h2>
    @if( $meetings )
        <table>
            <thead>
                <tr>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Étudiant</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $meetings as $meeting )
                    <tr>
                        <td>{{ date( 'j/m/Y H:i:s', $meeting -> start_time ) }}</td>
                        <td>{{ date( 'j/m/Y H:i:s', $meeting -> end_time ) }}</td>
                        <td><a href="{{ route('students.show', $meeting -> student_id) }}">{{ $meeting -> student -> name }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Il n'y a aucune rencontre prévue pour cet événement.</p>
    @endif

@stop
