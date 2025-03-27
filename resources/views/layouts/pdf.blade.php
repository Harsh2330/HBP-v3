<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        .text-center {
            text-align: center;
        }
        .text-blue-600 {
            color: #1c64f2;
        }
        .font-bold {
            font-weight: bold;
        }
        .text-2xl {
            font-size: 1.5em;
        }
        .text-xl {
            font-size: 1.25em;
        }
        .mb-4 {
            margin-bottom: 1rem;
        }
        .mt-6 {
            margin-top: 1.5rem;
        }
        .bg-white {
            background-color: #ffffff;
        }
        .border {
            border: 1px solid #e2e8f0;
        }
        .border-gray-200 {
            border-color: #edf2f7;
        }
        .min-w-full {
            min-width: 100%;
        }
        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .list-disc {
            list-style-type: disc;
        }
        .list-inside {
            list-style-position: inside;
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
