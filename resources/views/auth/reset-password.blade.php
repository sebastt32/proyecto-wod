<!-- resources/views/auth/reset-password.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input type="email" name="email" required placeholder="Email" value="{{ old('email', $request->email) }}">
        <input type="password" name="password" required placeholder="New Password">
        <input type="password" name="password_confirmation" required placeholder="Confirm Password">
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
