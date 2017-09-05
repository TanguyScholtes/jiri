@extends( 'layout' )

@section( 'title' )
    {{ $student -> name }}
@stop

@section( 'content' )

    <h1>{{ $student -> name }}</h1>

    <h2>Travaux</h2>
    @if( $implementations )
        <table>
            <thead>
                <tr>
                    <th>Projet</th>
                    <th>Version en ligne</th>
                    <th>Dépôt GitHub</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $implementations as $implementation )
                    <tr>
                        <td><a href="{{ route('projects.show', $implementation -> project_id) }}">{{ $implementation -> project -> name }}</td>
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
