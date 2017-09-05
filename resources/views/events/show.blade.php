@extends( 'layout' )

@section( 'title' )
    {{ $event -> course_name }} ({{ $event -> academic_year }})
@stop

@section( 'content' )

    <h1>{{ $event -> course_name }} ({{ $event -> academic_year }})</h1>
    <p>Année académique : {{ $event -> academic_year }}</p>
    <p>Session d'examen n°{{ $event -> exam_session }}</p>
    <p>Créateur : {{ $owner -> name }}</p>

    <h2>Dashboard</h2>

    <table>
        <thead>
            <tr>
                <th>Étudiants</th>
                <th>Jurys vus</th>
                @foreach( $users as $user )
                    @foreach( $projects as $project )
                        <th class="user-{{ $user -> id }}">{{ $project -> name }} - {{ $user -> name }}</th>
                    @endforeach
                    <th>Évaluation générale - {{ $user -> name }}</th>
                @endforeach
                @foreach( $projects as $project )
                    <th>{{ $project -> name }} - Moyenne</th>
                @endforeach
                <th>Évaluation générale - Moyenne</th>
                <th>Moyenne Mathématique</th>
                <th>Moyenne Délibération</th>
            <tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach( $students as $student )
                <tr>
                    <!-- Student name -->
                    <th class="table-left-column"><a href="{{ route('students.show', $student -> id) }}">{{ $student -> name }}</a></th>
                    <!-- Number of users seen -->
                    <td>
                        <?php $meetingsCount = 0; ?>
                        @foreach( $meetings as $meeting )
                            @if( $meeting -> student_id == $student -> id  )
                                <?php $meetingsCount++; ?>
                            @endif
                        @endforeach
                        {{ $meetingsCount }}
                    </td>
                    <!-- projects scores by user -->
                    @foreach( $users as $user )
                        <?php $thisMeeting = null; ?>
                        @foreach( $meetings as $meeting )
                            @if( $meeting -> student_id == $student -> id && $meeting -> user_id == $user -> id  )
                                <?php $thisMeeting = $meeting; break 1; ?>
                            @endif
                        @endforeach
                        @foreach( $projects as $project )
                            <?php $thisImplementation = null; ?>
                            @if( $thisMeeting != null )
                                @foreach( $implementations as $implementation )
                                    @if( $implementation -> project_id == $project -> id && $implementation -> student_id == $student -> id  )
                                        <?php $thisImplementation = $implementation; break 1; ?>
                                    @endif
                                @endforeach
                                @foreach( $thisImplementation -> scores as $score )
                                    @if( $score -> meeting_id == $thisMeeting['id'] )
                                        <td>{{ $score -> score }}</td>
                                        <?php break 1; ?>
                                    @endif
                                @endforeach
                            @else
                                <td>-</td>
                            @endif
                        @endforeach
                        <!-- general evaluation by user -->
                        <td>
                            @if( $thisMeeting != null )
                                {{ $thisMeeting[ 'general_evaluation' ] }}
                            @else
                                -
                            @endif
                        </td>
                    @endforeach
                    <?php $projectsAverages = []; ?>
                    <!-- average score by project -->
                    @foreach( $projects as $project )
                        <?php $projectTotal = 0; $thisImplementation = null; $notationsCount = 0; ?>
                        @foreach( $implementations as $implementation )
                            @if( $implementation -> project_id == $project -> id && $implementation -> student_id == $student -> id  )
                                <?php $thisImplementation = $implementation; break 1; ?>
                            @endif
                        @endforeach
                        @foreach( $thisImplementation -> scores as $score )
                            @if( isset( $score -> score ) )
                                <?php $projectTotal += $score -> score; $notationsCount++; ?>
                            @endif
                        @endforeach
                        <?php $projectAverage = round( $projectTotal / $notationsCount, 1 ); ?>
                        <?php $projectsAverages[] = $projectAverage; /*averages created and stocked with same iterator as projects in objects collection $projects*/ ?>
                        <td>{{ $projectAverage }}</td>
                    @endforeach
                    <!-- average general evaluation -->
                    <?php $meetingsCount = 0; $genevalTotal = 0; ?>
                    @foreach( $meetings as $meeting )
                        @if( $meeting -> student_id == $student -> id  )
                            <?php $genevalTotal += $meeting -> general_evaluation; $meetingsCount++; ?>
                        @endif
                    @endforeach
                    <?php $genevalAverage = round( $genevalTotal / $meetingsCount, 1 ); ?>
                    <td>{{ $genevalAverage }}</td>
                    <!-- mathematical evaluation with ponderation -->
                    <?php $ponderationPercentile = 0;
                        $math = 0;
                        $projectsCount = count( $projects );
                        //math eval for projects
                        for( $i = 0; $i < $projectsCount; $i++ ){
                            $math += $projectsAverages[ $i ] * $projects[ $i ] -> weight;
                            $ponderationPercentile += $projects[ $i ] -> weight;
                        }
                        //add general eval with remaining percentile of ponderation to math eval
                        $math += $genevalTotal * ( 1 - $ponderationPercentile );
                    ?>
                    <td>{{ $math }}</td>
                    <td>délibé</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Projets :</h2>
    @if( $projects )
        <ul>
            @foreach( $projects as $project )
                <li><a href="{{ route('projects.show', $project -> id) }}">{{ $project -> name }}</a>
                    (Pondération : {{ $project -> weight }})
                </li>
            @endforeach
        </ul>
    @else
        <p>Il n'y a aucun projet pour cet événement.</p>
    @endif

    <h2>Jury :</h2>
    @if( $users )
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Entreprise</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $users as $user )
                    <tr>
                        <td><a href="{{ route('users.show', $user -> id) }}">{{ $user -> name }}</a></td>
                        <td>{{ $user -> company }}</td>
                        <td><a href="mailto:{{ $user -> email }}">{{ $user -> email }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Il n'y a aucun jury prévu pour cet événement.</p>
    @endif

    <h2>Rencontres :</h2>
    @if( $meetings )
        <table>
            <thead>
                <tr>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Jury</th>
                    <th>Étudiant</th>
                    <th>Évaluation générale</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $meetings as $meeting )
                    <tr>
                        <td>{{ date( 'j/m/Y H:i:s', $meeting -> start_time ) }}</td>
                        <td>{{ date( 'j/m/Y H:i:s', $meeting -> end_time ) }}</td>
                        <td><a href="{{ route('users.show', $meeting -> user_id) }}">{{ $meeting -> user -> name }}</a></td>
                        <td><a href="{{ route('students.show', $meeting -> student_id) }}">{{ $meeting -> student -> name }}</a></td>
                        <td>{{ $meeting -> general_evaluation }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Il n'y a aucune rencontre prévue pour cet événement.</p>
    @endif

    <h2>Implémentations :</h2>
    @if( $implementations )
        <table>
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Projet</th>
                    <th>Version en ligne</th>
                    <th>Dépôt GitHub</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $implementations as $implementation )
                    <tr>
                        <td><a href="{{ route('students.show', $implementation -> student_id) }}">{{ $implementation -> student -> name }}</a></td>
                        <td><a href="{{ route('projects.show', $implementation -> project_id) }}">{{ $implementation -> project -> name }}</td>
                        <td><a href="{{ $implementation -> url_project }}">{{ $implementation -> url_project }}</a></td>
                        <td><a href="{{ $implementation -> url_repo }}">{{ $implementation -> url_repo }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Il n'y a aucune implémentation prévue pour cet événement.</p>
    @endif

@stop
