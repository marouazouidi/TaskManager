<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 ">

<div class="flex flex-col min-h-screen">

    @include('layouts.navbar')

    <div class="flex flex-1">

        @include('layouts.sidebar')

        <main class="flex-1 ml-64 mt-20 p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>