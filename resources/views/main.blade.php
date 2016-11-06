<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="/img/favicon64.png" />
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/components/Materialize/dist/css/materialize.min.css" type="text/css" rel="stylesheet"
          media="screen"/>
    <link href="/components/materialid/dist/materialid.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/components/font-awesome/css/font-awesome.min.css">
    <link href="/css/style.min.css" type="text/css" rel="stylesheet" media="screen"/>
</head>
<body @yield('body_class')>
<div id="wrapper">
    <div id="header">
        @include("_nav")
    </div>
    <div id="content">
        @yield("content")
    </div>
    <div id="footer">
        @include('_footer')
    </div>
</div>

        <!--  Scripts-->
<script src="/components/jquery/dist/jquery.min.js"></script>
<script src="/components/jquery.cookie/jquery.cookie.js"></script>
<script src="/components/Materialize/dist/js/materialize.min.js"></script>
<script src="/components/materialid/dist/materialid.min.js"></script>
<script src="/components/materialid/language/es_ES.js"></script>
<script src="/components/pickadate/lib/compressed/picker.js"></script>
<script src="/components/pickadate/lib/compressed/picker.date.js"></script>
<script src="/components/pickadate/lib/compressed/translations/es_ES.js"></script>
<script src="/js/ddsi.min.js"></script>
@if(Session::has('flash_message'))
    <script>
        Materialize.toast('{{session('flash_message')}}',6000);
    </script>
@endif
@yield('scripts')
</body>
</html>
