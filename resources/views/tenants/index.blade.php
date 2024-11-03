@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body text-center">
                        <h1>Inquilinos</h1>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Dominio</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenants as $tenant)
                                    <tr>
                                        <td>{{ $tenant->id }}</td>
                                        <td>{{ $tenant->domains->first()->domain ?? '' }}</td>
                                        <td>
                                            <form action="{{ route('tenants.destroy', $tenant) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </td>
                                        <td><a href="{{ route('tenants.edit', $tenant) }}">Editar</a></td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('tenants.create') }}" class="btn btn-primary">Nuevo</a>
        </div>
    </div>
@endsection
