<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title ?? '' }} &mdash; Colorlib e-Commerce </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('layouts.partials.css')
</head>

<body>

<div class="site-wrap">
    @include('layouts._header')

    @yield('content')

    @include('layouts._footer')
</div>

@include('layouts.partials.js')

</body>

</html>
