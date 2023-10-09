<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>BIMMS - Engineering</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    </head>

    <body>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        <main>
            @include('partials._navbar')

            @yield('content')
            @yield('scripts')
            
            
        </main>
        @include('partials._footer')
    </body>

</html>