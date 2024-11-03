@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header"></div>
          <div class="card-body">
            <form method="POST" action="{{route('registration.post')}}" >
              @csrf
              <div class="form-group row">
                
                <div class="col-lg-8">
                  <div class="form-group">
                    <h1>Por favor confirma tu cuenta desde tu correo para activarla</h1>
                    
                 
                  </div>
                  <button type="submit" class="btn btn-primary">Volver al login</button>
                </div>
                <input type="hidden" name="email" id="email" value="{{$email}}">
                <input type="hidden" name="password" id="password" value="{{$password}}">
                <input type="hidden" name="name" id="name" value="{{$name}}">
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

