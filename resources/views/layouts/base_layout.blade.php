{{--
    Shazkho'S CRUD Plugin 0.1 - Base layout
    ---------------------------------------
    This file is meant to be used as part of the Shazkho's CRUD Plugin layout. It uses some
    external resources so be sure you are using a working internet connection on local host. Offline versions
    can be auto-generated also, but is recommended to use this version to always load lastest's version.

    IMPORTANT:  This file can be modified. Just try not to break anything, do it if you are really
                sure of what you are doing.

    Template sections that MUST be implemented on importing views:
        - title:    The title shown on browser title (as <title> HTML tag).
        - content:  The page's content.

    This version is using the following HTML/CSS/JS libraries/frameworks (loaded as shown order):
        - [JavaScript] jQuery 3.3.1 slim
        - [JavaScript] Popper 1.14.7
        - [JavaScript] Bootstrap 4.3.1
        - [CSS] Bootstrap 4.3.1
        - [CSS] Font Awesome 5.8.2

    Plugin version:     0.1
    File version:       1.0
    Version date:       2019/06/03
    Laravel version:    5.8.*
--}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- External Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- External Fonts -->

    <!-- External Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


    <!-- LOCAL RESOURCES (PUT HERE YOUR LOCAL JS/CSS/FONTS FILES) -->
    <!-- Local Scripts -->

    <!-- Local Fonts -->

    <!-- Local Styles -->


</head>
<body>
<div id="app">

    <main class="py-4">
        <div class="container">

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @yield('content')
        </div>
    </main>
</div>
<script>
    $(function() {
        $(".alert-success").delay(2000).fadeOut();
    });
</script>
</body>
</html>
