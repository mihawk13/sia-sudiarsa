<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ env('APP_NAME') }}</title>
    <!-- Meta tag Keywords -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="keywords"
        content="connect error page Widget a Flat Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <!-- Meta tag Keywords -->
    <link rel="stylesheet" href="{{ asset('errors/css/style.css') }}" type="text/css" media="all" /><!-- Style-CSS -->
    <link rel="stylesheet" href="{{ asset('errors/css/font-awesome.min.css') }}" type="text/css" media="all" />
    <link href="{{ asset('errors/css/popup-box.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="//fonts.googleapis.com/css?family=Gafata" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
</head>

<body>
    <section class="agile-main">
        <header>
            <h1>Error Page</h1>
        </header>
        <div class="agile-top">
            <h2><sup>4</sup>0<sup>4</sup></h2>
            <span>Halaman tidak ditemukan</span>
            <p>Halaman Yang Anda Tuju Mungkin Telah Diubah</p>
        </div>
        <div class="agile-buttons">
            <button class="go"><a href="{{ route('dashboard') }}">Kembali ke Dashboard</a></button>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} error page. All rights reserved | Design by <a href="http://w3layouts.com"
                    target="_blank">W3layouts</a></p>
        </div>
    </section>
    <script src="{{ asset('errors/js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('errors/js/jquery.magnific-popup.js') }}"></script>
    <script>
        $(document).ready(function() {
		$('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			easing: 'ease-in-out',
			mainClass: 'my-mfp-zoom-in'
		});

		});
    </script>

</body>

</html>
