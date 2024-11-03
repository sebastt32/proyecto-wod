@extends('tenancy.layoutsSubDomain')

@section('title', 'login')

@section('content')
    <div class="container">


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

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jsencrypt/3.0.0/jsencrypt.min.js"></script> --}}

        {{-- Tienes que añadir el csrf para verificar que las peticiones solo se realicen desde tu pagina web --}}
        {{-- {{ route('login.post') }} --}}
        <form action="{{ route('login.post') }}" method="post" class="ms-auto me-auto mt-auto" style="width: 500px"
            onsubmit="sendform_login(event)">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email">

            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            <input type="hidden" name="palabra" id="palabra">

             <input type="hidden" name="g-recaptcha-response_v3" id="g-recaptcha-response_v3"> 

             <div class="g-recaptcha" data-sitekey="6Lc9-w8qAAAAABdXkiZkRvI2i3r0jHK--4ahNelZ"></div> 


            <button type="submit" class="btn btn-primary">Submit</button>


            {{-- <input type="hidden" name="public-key" value="{{ file_get_contents(storage_path('keys/private_key.pem')) }}"> --}}

            <div>
                <a href="{{ route('password.request') }}">Forgot password?</a>
            </div>
        </form>
        <!-- sentencias recaptcha v2 -->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <!-- sentencias recaptcha v3 -->
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('captcha.sitekey') }}"></script>
        <script>
            grecaptcha.ready(function() {
                grecaptcha.execute('6Len-A8qAAAAAJCVQ93EkXaEewFQ8dU9I3gBIZQs', {
                    action: 'submit'
                }).then(function(token) {
                    // Adjuntar el token a tu formulario como un campo oculto
                    document.getElementById('g-recaptcha-response_v3').value = token;


                });
            });
        </script> 







        {{--
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jsencrypt/3.0.0/jsencrypt.min.js"></script>
        <script>
            function sendform_login(event) {
                event.preventDefault();

                const encryptor = new JSEncrypt();
                const publicKey = event.target.querySelector('[name="public-key"]').value;

                encryptor.setPublicKey(publicKey);

                const emailInput = event.target.querySelector('[name="email"]');
                const passwordInput = event.target.querySelector('[name="password"]');

                const email_ec = encryptor.encrypt(emailInput.value);
                const password_ec = encryptor.encrypt(passwordInput.value);

                emailInput.type = 'password';
                passwordInput.type = 'password';

                //encriptaciones
                emailInput.value = email_ec;
                passwordInput.value = password_ec;

                event.target.submit();
            }
        </script> --}}
    </div>

@endsection
