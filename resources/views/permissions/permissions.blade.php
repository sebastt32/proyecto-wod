@extends('layout')


@section('title', 'Registration')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Assign Roles</title>
</head>
<body>
    <h1>Users</h1>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Assign Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>
                        <form action="{{ route('users.assign-role', $user) }}" method="POST">
                            @csrf
                            <select name="role" required>
                                <option value="">Select a role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit">Assign</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

@endsection
