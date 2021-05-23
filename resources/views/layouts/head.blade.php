<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
<title>{{ env('APP_NAME') }}</title>
<!-- Bootstrap Core CSS -->
<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
<!-- You can change the theme colors from here -->
<link href="{{ asset('assets/css/colors/blue.css') }}" id="theme" rel="stylesheet">

@yield('css')
