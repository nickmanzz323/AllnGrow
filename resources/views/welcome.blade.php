<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InGrow - Online Course & Certification</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="InGrow Logo" class="h-24">
        </div>
        <h1 class="text-4xl font-bold mb-4">Welcome to InGrow</h1>
        <p class="text-lg text-gray-300 mb-6">
            Online Course & Certification Platform.  
            Learn new skills, grow your career, and achieve your goals with us.
        </p>
        <div class="space-x-4">
            <a href="{{ url('/courses') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg">Explore Courses</a>
            <a href="{{ url('/register') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg">Get Started</a>
        </div>
    </div>
</body>
</html>
