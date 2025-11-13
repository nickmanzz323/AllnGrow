<!DOCTYPE html>
<html>
<head>
    <title>Teacher</title>
</head>
<body>
    <h1>Dashboard Teacher</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>