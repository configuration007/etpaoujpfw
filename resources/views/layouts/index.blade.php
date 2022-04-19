<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/assets/images/favicon.ico" />

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" />
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/assets/images/icon.png">
    <meta name="keywords" content="  Best crypto currency mining platform with blockchain 
                        technology, smart contracts , multi-nodes and high returns.
                        mine bitcoin directly from the comfort of your home
                    ">
    <link rel="shortcut icon" type="image/ico" href="/assets/images/favicon.ico">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400;subset=latin">
    <title>Blockchain Info</title>
    @yield('css')
</head>

<body>
    @extends('partials._header')
    @yield('content')
    @extends('partials._footer')
</body>
@extends('partials._scripts')
@yield('scripts')
</html>
