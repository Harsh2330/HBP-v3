<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME BASED PALLIATIVE CARE</title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head> 
    
<body class="bg-gradient-to-b from-blue-100 to-blue-300 text-gray-800">
    <header class="p-6 bg-blue-600 shadow-md">
        <h1 class="text-4xl font-bold text-white">HOME BASED PALLIATIVE CARE</h1>
        <nav class="mt-4 flex justify-center space-x-6">
            <a href="#" class="text-lg text-white hover:text-blue-300">Home</a>
            <a href="#" class="text-lg text-white hover:text-blue-300">Services</a>
            <a href="{{ route('about-us') }}" class="text-lg text-white hover:text-blue-300">About Us</a>
            <a href="{{ route('login') }}" class="text-lg text-white hover:text-blue-300">Login</a>
            <a href="{{ route('register') }}" class="text-lg text-white hover:text-blue-300">Register</a>
        </nav>
    </header>
</body>
</html>