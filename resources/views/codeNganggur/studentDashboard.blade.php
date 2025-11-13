<!DOCTYPE html>
<html>
<head>
    <title>Student</title>
</head>
<body>
    <h1>Dashboard Student</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>