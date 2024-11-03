@extends('layout')

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

                        <form action="{{ route('tenants.update', $tenant) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="mb-3">
                                <label class="form-label ">Nombre</label>
                                <input type="text" value="{{ old('id', $tenant->id) }}" class="form-control"
                                    name="id" placeholder="Ingrese el nombre">

                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary">Actualizar</button>

                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
