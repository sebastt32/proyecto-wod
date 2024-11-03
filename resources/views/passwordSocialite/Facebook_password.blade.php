@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('registration.post') }}">
                            @csrf
                            <div class="form-group row">

                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <h1>Escribe una nueva contraseña para tu cuenta</h1>
                                        <input type="text" name="password">

                                    </div>
                                    <button type="submit" class="btn btn-primary">Activar Cuenta</button>
                                </div>
                                <input type="hidden" name="email" id="email" value="{{ $email }}">
                                <input type="hidden" name="name" id="name" value="{{ $name }}">


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
