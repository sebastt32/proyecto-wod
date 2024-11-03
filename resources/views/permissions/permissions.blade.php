@extends('layout')


@section('title', 'Registration')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Assign Roles</title>
</head>
<body>

</body>
</html>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body text-center">
                    <h1>Users Permissions</h1>
                    @if (session('success'))
                        <div>{{ session('success') }}</div>
                    @endif
                    <table class="align-items">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Assign Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">
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
                </div>
            </div>
        </div>
    </div>

@endsection
