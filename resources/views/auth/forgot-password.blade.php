<!-- resources/views/auth/forgot-password.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>
    <h1>Forgot Password</h1>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" required placeholder="Email">
        <button type="submit">Send Password Reset Link</button>
    </form>
</body>
</html>