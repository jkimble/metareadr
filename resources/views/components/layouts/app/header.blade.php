<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="bg-gray-800 pb-12">
{{ $slot }}
<x-toast/>
</body>
</html>
