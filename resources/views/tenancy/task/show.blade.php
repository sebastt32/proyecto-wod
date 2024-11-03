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

                        <h1>{{ $task->name }}</h1>

                        <p>{{ $task->description }}</p>

                        <img src="{{ route('file', $task->image_url) }}" alt="" class="img-fluid">


                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
