<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Custom auth laravel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <script src="https://www.google.com/recaptcha/api.js?render={{ config('captcha.sitekey') }}"></script> --}}

    <!-- <script>
        document.addEventListener('submit', function(e) {


            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('6LcOIdUpAAAAANvJxsPLuJZWTT531PejXaTBQs3l', {
                    action: 'submit'
                }).then(function(token) {

                    let form = e.target;

                    form.document.getElementById('g-recaptcha-response').value = token;

                    form.submit();
                });
            });


        })
    </script>     -->

</head>

<body>
    @include('include.headerSubDomain')
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
