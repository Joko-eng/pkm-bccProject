<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <title>BCC</title>
</head>
<body>
    <div class="antialiased bg-white dark:bg-gray-900">
        {{-- Sidebar --}}
        <x-sidebar></x-sidebar>

        {{-- Main --}}
        <main class="p-4 md:ml-64 h-screen pt-2">
            {{ $slot }}
        </main>
    </div>
</body>
</html>

