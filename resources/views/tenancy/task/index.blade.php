@extends('tenancy.layoutsSubDomain')

@section('content')





    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body text-center">
                        <div class="mt-5">
                            @if ($errors->any())
                                <div class="col-12">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif



                            @if (session()->has('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if (session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                        </div>

                        <h1>Tareas</h1>
                        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Crear tarea</a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->name }}</td>
                                        <td>{{ $task->description }}</td>
                                        <td>
                                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-primary">Ver</a>
                                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">Editar</a>

                                        </td>
                                        <td>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Eliminar</button>
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

    </div>
@endsection
