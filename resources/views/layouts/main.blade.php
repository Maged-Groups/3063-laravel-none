<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta-description', 'Description of the website....')">
    <title>@yield('page-title', '3063 App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="p-5">

    @include('structure.top-navbar')

    {{-- Pages Content --}}
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>