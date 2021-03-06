<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- load icon font -->
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdn.muicss.com/mui-0.9.41/css/mui.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
        <title>Laravel</title>
    </head>
    <body>
        <div id="app">
            {{-- <app></app> --}}
        </div>
        
        {{-- LOAD JS FILES --}}
        {{-- <script src="{{asset('js/app.js')}}"></script> --}}
        <script src="//cdn.muicss.com/mui-0.9.41/js/mui.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.js"></script>
    </body>
</html>
