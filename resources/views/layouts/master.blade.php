<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        @include('partials.navbar')
        @include('partials.sidebar')

        {{-- Content --}}
        <div class="content-wrapper">
            <router-view></router-view>
            <vue-progress-bar></vue-progress-bar>

        </div>
        @include('partials.footer')

    </div>
    @auth
    <script>
        window.user = @json(auth()->user())
    </script>
    @endauth
    @include('partials.script')

</body>

</html>