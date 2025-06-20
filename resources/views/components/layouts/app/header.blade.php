<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="bc-zinc-400 dark:bg-zinc-800">
{{ $slot }}
</body>
</html>
