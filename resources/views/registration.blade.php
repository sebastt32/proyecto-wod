@extends('layout')


@section('title', 'Registration')

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
        <form action="{{ route('confirm.email') }}" method="POST" class="ms-auto me-auto mt-auto" style="width: 500px" onsubmit="sendform_login(event)">
            {{-- Tienes que añadir el csrf para verificar que las peticiones solo se realicen desde tu pagina web --}}
            @csrf

            <div class="mb-3">
                <label class="form-label">Fullname</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name">

            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email">

            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="g-recaptcha" data-sitekey="6Lc9-w8qAAAAABdXkiZkRvI2i3r0jHK--4ahNelZ"></div>

            <input type="hidden" name="g-recaptcha-response_v3" id="g-recaptcha-response_v3">

            <div class="mt-4" style="text-align: center">
                <a href="{{ route('autho.redirect') }}" type="button" class="btn btn-primary">Iniciar sesion
                    con
                    Facebook
                </a>
            </div>

            <div class="mt-4" style="text-align: center">
                <a href="{{ route('authg.redirect') }}" type="button" class="btn btn-danger">Iniciar sesion
                    con
                    Google
                </a>
            </div>
            <input type="hidden" name="public-key" value="{{ file_get_contents(storage_path('keys/private_key.pem')) }}">

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- sentencias recaptcha v2 -->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <!-- sentencias recaptcha v3 -->
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('captcha.sitekey') }}"></script>
        <script>
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config('captcha.sitekey') }}', {
                    action: 'submit'
                }).then(function(token) {
                    // Adjuntar el token a tu formulario como un campo oculto
                    document.getElementById('g-recaptcha-response_v3').value = token;


                });
            });
        </script>


            {{-- Metodos de encriptacion --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jsencrypt/3.0.0/jsencrypt.min.js"></script>
            <script>
                function sendform_login(event) {
                    event.preventDefault();

                    const encryptor = new JSEncrypt();
                    const publicKey = event.target.querySelector('[name="public-key"]').value;

                    encryptor.setPublicKey(publicKey);

                    const fullname = event.target.querySelector('[name="name"]')
                    const emailInput = event.target.querySelector('[name="email"]');
                    const passwordInput = event.target.querySelector('[name="password"]');

                    const fullname_ec = encryptor.encrypt(fullname.value);
                    const email_ec = encryptor.encrypt(emailInput.value);
                    const password_ec = encryptor.encrypt(passwordInput.value);

                    fullname.type = 'hidden';
                    emailInput.type = 'hidden';
                    passwordInput.type = 'hidden';

                    //encriptaciones
                    fullname.value = fullname_ec;
                    emailInput.value = email_ec;
                    passwordInput.value = password_ec;

                    event.target.submit();
                }
            </script>
    </div>

@endsection
