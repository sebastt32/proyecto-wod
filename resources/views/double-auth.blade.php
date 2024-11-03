@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header"></div>
          <div class="card-body">
            <form method="POST" action="{{route('login.post')}}" >
              @csrf
              <div class="form-group row">
                <div class="col-lg-4">
                    <p> <img src="data:image/svg+xml;base64,<?php echo $encoded_qr_data; ?>" alt="QR Code"></p>
                </div>
                <div class="col-lg-8">
                  <div class="form-group">
                    <label for="code_verification" class="col-form-label">
                      {{ __('CÓDIGO DE VERIFICACIÓN') }}
                    </label>
                    <input 
                      id="code_verification" 
                      type="text" 
                      class="form-control{{ $errors->has('code_verification') ? ' is-invalid' : '' }}" 
                      name="code_verification"
                      value="{{ old('code_verification') }}" 
                      required
                      autofocus>
                    @if ($errors->has('code_verification'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('code_verification') }}</strong>
                      </span>
                    @endif
                  </div>
                  <button type="submit" class="btn btn-primary">ENVIAR</button>
                </div>
                <input type="hidden" name="email" id="email" value="{{$emailCifrado}}">
                <input type="hidden" name="password" id="password" value="{{$passwordCifrado}}">
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response" value="{{$recaptchav2}}">
                <input type="hidden" name="g-recaptcha-response_v3" id="g-recaptcha-response_v3" value="{{$recaptchav3}}">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection



 