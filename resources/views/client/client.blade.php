<!DOCTYPE html>
<html>
<head>
    <title>Client Profile</title>
</head>
<body>
<h1>Welcome, {{ $user->name }}!</h1>

<p>Your email is: {{ $user->email }}</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf

    <div>
        <button type="submit">
            Logout
        </button>
    </div>
</form>
</body>
</html>
