@extends( 'layout' )

@section( 'title' )
    {{ $project -> name }}
@stop

@section( 'content' )

    <h1>{{ $project -> name }}</h1>

    <p>Pondération : {{ $weight -> weight }}</p>

    <h2>Description</h2>
    <p>{{ $project -> description }}</p>

    <h2>Travaux</h2>
    @if( $implementations )
        <table>
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Version en ligne</th>
                    <th>Dépôt GitHub</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $implementations as $implementation )
                    <tr>
                        <td><a href="{{ route('students.show', $implementation -> student_id) }}">{{ $implementation -> student -> name }}</a></td>
                        <td><a href="{{ $implementation -> url_project }}">{{ $implementation -> url_project }}</a></td>
                        <td><a href="{{ $implementation -> url_repo }}">{{ $implementation -> url_repo }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Il n'y a aucun travail à afficher.</p>
    @endif

@stop
