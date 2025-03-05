<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 50px;
        }
        h1 {
            color: #4CAF50;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .highlight {
            font-weight: bold;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container mx-auto bg-white p-8 shadow-lg rounded-lg mt-12">
        <h1 class="text-4xl font-bold text-green-500 mb-4">Welcome to Our Platform!</h1>
        <p class="text-lg mb-2">Your registration was successful.</p>
        <p class="text-lg mb-2"><strong class="highlight font-semibold text-green-500">User ID:</strong> {{ $mailData['id'] }}</p>
        <p class="text-lg mb-2"><strong class="highlight font-semibold text-green-500">Email:</strong> {{ $mailData['email'] }}</p>
        <p class="text-lg mb-2"><strong class="highlight font-semibold text-green-500">Password:</strong> {{ $mailData['password'] }}</p>
        <p class="text-lg mb-4">We are excited to have you on board and look forward to providing you with the best service possible.</p>
        <p class="text-lg mb-4">If you have any questions, feel free to contact our support team.</p>
        <p class="text-lg">Thank you for joining us!</p>
    </div>
</body>
</html>
