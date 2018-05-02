@inject('pr', 'App\Presenters\AppPresenter')
@inject('request', 'Illuminate\Http\Request')

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pr->getTitle($request) }}</title>

    @include('common.meta')

    <!-- Preload -->
    <link rel="preload" href="{{ asset('public' . mix('/css/app.css')) }}" as="style">
    <link rel="preload" href="{{ asset('public' . mix('/js/manifest.js')) }}" as="script">
    <link rel="preload" href="{{ asset('public' . mix('/js/vendor.js')) }}" as="script">
    <link rel="preload" href="{{ asset('public' . mix('/js/app.js')) }}" as="script">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('public' . mix('/css/app.css')) }}">
    @yield('style')

    <!-- Script -->
    <script defer src="{{ asset('public' . mix('/js/manifest.js')) }}"></script>
    <script defer src="{{ asset('public' . mix('/js/vendor.js')) }}"></script>
    <script defer src="{{ asset('public' . mix('/js/app.js')) }}"></script>
  </head>

  <body>

    <div id="app">
      @include('common/nav')

      <div class="main" style="padding-top: 59px">
        @yield('content')
      </div>

      @include('common/footer')
    </div>

    @yield('script')

  </body>
</html>