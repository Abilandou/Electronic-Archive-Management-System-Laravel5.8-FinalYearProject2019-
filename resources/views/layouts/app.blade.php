<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! MaterializeCSS::include_full() !!}
    <link rel="stylesheet" charset="utf-8" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" charset="utf-8" href="http://yourdomain.com/materialize-css/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://yourdomain.com/materialize-css/js/materialize.min.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EDMS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />

    <link rel="stylesheet" href="{{ asset('iconfont/material-icons.css') }}">
    <!-- Materialize css -->
    <link rel="stylesheet" href="{{ asset('materialize-css/css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
     <link rel="stylesheet" href="{{ asset('css/materialize.css') }}">
     <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <!-- datatables -->
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/table1.min.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/table2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/DataTables-1.10.15/css/jquery.dataTables.css') }}">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/storage/images/favicon.ico">




    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    @include('snippets.spinner')
    <main>
        <div id="app">


          @include('snippets.navbar')

             @yield('content')

             {{-- </script> --}}
             <!-- Floating Button -->
              @if(Auth::guest())
              @else

              <div class="fixed-action-btn">
                <a href="#" id="first" class="btn btn-floating btn-large tooltipped" title="Quick Access" data-position="left" id="mainBut" data-delay="50" data-tooltip="Quick Access">
                  <i class="large material-icons">explore</i>
                </a>
                <ul id="altBut">
                  <li>
                    <a href="/documents/create" class="btn-floating btn-large tooltipped" title="Upload Document" data-position="left" data-delay="50" data-tooltip="File Upload"><i class="large material-icons">file_upload</i></a>
                  </li>
                  <li class="hide-on-med-and-down">
                    <a href="" class="btn-floating btn-large button-collapse tooltipped" title="Menu" data-activates="slide-out" data-position="left" data-delay="50" data-tooltip="Menu"><i class="large material-icons">menu</i></a>
                  </li>
                </ul>
              </div>

              @endif

            </main>
            @include('snippets.footer')
            @include('snippets.scripts')
        </div>
    <script src="{{ asset('js/materialize.min.js') }}"></script>
    <script src="{{ asset('js/materialize.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="{{ asset('js/context-menu.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.js') }}"></script>
    <script src="{{ asset('DataTables/DataTables-1.10.15/js/jquery.dataTables.js') }}"></script>

</body>
</html>
