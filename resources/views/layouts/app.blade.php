<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! MaterializeCSS::include_full() !!}
  <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EDMS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

     <link rel="stylesheet" href="{{ asset('css/main.css') }}">

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

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}" charset="utf-8"></script>

</body>
</html>
