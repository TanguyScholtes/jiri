@extends( 'layout' )

@section( 'title' )
    Modifier l'évaluation
@stop

@section( 'content' )

    <h1>Modifier l'évaluation</h1>

    <p>Travail évalué : <a href="{{ route('projects.show', $implementation -> project -> id) }}">{{ $implementation -> project -> name }}</a> par <a href="{{ route('students.show', $meeting -> student -> id) }}">{{ $meeting -> student -> name }}</a></p>
    <p>URL du travail : <a href="{{ $implementation -> url_project }}">{{ $implementation -> url_project }}</a></p>
    <p>Dépôt GitHub : <a href="{{ $implementation -> url_repo }}">{{ $implementation -> url_repo }}</a></p>

    <form method="POST" action="{{ route('scores.update', $score -> id) }}" enctype="multipart/form-data">
        <p>
            <label for="score">Note :</label>
            <input type="number" step="0.01" min="0" max="20" id="score" name="score" value="{{ $_SESSION[ 'score' ] }}">
        </p>
        <div>
            <label for="comment">Commentaire :</label>
            <textarea>{{ $_SESSION[ 'comment' ] }}</textarea>
        </div>
        <input type="hidden" id="scoreId" value="{{ $score -> id }}">
        <p><input type="submit" value="Modifier"></p>
    </form>

@stop
