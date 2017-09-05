@extends( 'layout' )

@section( 'title' )
    Évaluation
@stop

@section( 'content' )

    <h1>Évaluation</h1>

    <p>Jury : <a href="{{ route('users.show', $meeting -> user -> id) }}">{{ $meeting -> user -> name }}</a></p>
    <p>Travail évalué : <a href="{{ route('projects.show', $implementation -> project -> id) }}">{{ $implementation -> project -> name }}</a> par <a href="{{ route('students.show', $meeting -> student -> id) }}">{{ $meeting -> student -> name }}</a></p>
    <p>URL du travail : <a href="{{ $implementation -> url_project }}">{{ $implementation -> url_project }}</a></p>
    <p>Dépôt GitHub : <a href="{{ $implementation -> url_repo }}">{{ $implementation -> url_repo }}</a></p>
    <p>Note : {{ $score -> score }}</p>
    <p>Commentaire : {{ $score -> comment }}</p>

@stop
