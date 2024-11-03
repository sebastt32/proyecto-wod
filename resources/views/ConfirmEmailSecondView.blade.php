@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header"></div>
          <div class="card-body">
            <form method="POST" action="{{route('confirm.email.last')}}" >
              @csrf
              <div class="form-group row">
                
                <div class="col-lg-8">
                  <div class="form-group">
                    <h1>Deseas activar tu cuenta</h1>
                    
                 
                  </div>
                  <button type="submit" class="btn btn-primary">Activar Cuenta</button>
                </div>
                <input type="hidden" name="email" id="email" value="{{$email}}">
               
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection