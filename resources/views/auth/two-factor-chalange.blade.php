@extends('tenancy.layoutsSubDomain')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Two factor challenge') }}</div>

                    <div class="card-body">
                        {{ __('Please enter your authentication code to login.') }}

                        <form method="POST" action="{{ route('login')}}">
                            @csrf

                            <div class="row mb-3">
                                <label for="code" class="col-md-4 col-form-label text-md-end">{{ __('Code') }}</label>

                                <div class="col-md-6">
                                    <input id="code" type="code" class="form-control @error('code') is-invalid @enderror" name="code" required >
                                    <input type="hidden" value="hola" name="acceso">
                                    <input type="hidden" value="{{$email}}" name="email">
                                    <input type="hidden" value="{{$password}}" name="password">

                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm Code') }}
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
@endsection