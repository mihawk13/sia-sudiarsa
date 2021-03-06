<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>{{ env('APP_NAME') }}</title>

    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Google fonts -->
    <link href="//fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="{{ asset('logins/css/style.css') }}" type="text/css" media="all" />
    <style>
        .text-danger {
            color: #ef5350 !important;
        }
    </style>
</head>

<body>
    <div class="signinform">
        <h1>Sistem Informasi Akuntansi<br>Sudiarsa Helm</h1>
        <!-- Validation Errors -->
        <!-- container -->
        <div class="container">
            <!-- main content -->
            <div class="w3l-form-info">
                <div class="w3_info">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <h2>Login</h2>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <span><i class="fas fa-user" aria-hidden="true"></i></span>
                            <input type="text" name="username" placeholder="Username" required>
                        </div>
                        <div class="input-group">
                            <span><i class="fas fa-key" aria-hidden="true"></i></span>
                            <input type="password" name="password" placeholder="Password" required="">
                        </div>
                        <div class="form-row bottom">
                            <div class="form-check">
                                <input type="checkbox" id="remenber" name="remenber" value="remenber">
                                <label for="remenber"> Remember me?</label>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Login</button>
                    </form>
                </div>
            </div>
            <!-- //main content -->
        </div>
        <!-- //container -->
        <!-- footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Sistem Informasi Akuntansi. All Rights Reserved | Design by <a
                    href="https://w3layouts.com/" target="blank">W3layouts</a></p>
        </div>
        <!-- footer -->
    </div>

    <!-- fontawesome v5-->
    <script src="{{ asset('logins/js/fontawesome.js') }}"></script>

</body>

</html>
