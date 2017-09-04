<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="fr" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="fr" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="fr" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="fr" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="Laravel app designed to help organize and monitor a final's jury.">
        <meta name="author" content="Tanguy Scholtés">
        <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
        <link rel="shortcut icon" type="image/png" href="{{ URL::asset('img/favicon.png') }}" />

        <title>@yield( 'title' ) - Jiri</title>
    </head>
    <body>

        @include( '_navigation/navigation' )

        <main class="main-container">
            @yield( 'content' )
        </main> <!-- .content -->

        @include( 'footer' )
    </body>
</html>
