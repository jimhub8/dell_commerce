<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="/storage/icons/favicon.png" />
    <!--===============================================================================================-->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet"> {{--
    <link href="{{ asset('fonts/themify/themify-icons.css') }}" rel="stylesheet"> --}} {{--
    <link href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}" rel="stylesheet"> --}}
    <!--===============================================================================================-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/elegant-font/html-css/style.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/slick/slick.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/lightbox2/css/lightbox.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main1.css') }}">
    <!--===============================================================================================-->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> {{--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous"> --}}
</head>

<body class="animsition">
    <div id="app">
        {{--
    @include('include.header') --}}
        <main class="py-4">
            @yield('content')
        </main>
        {{--
    @include('include.Footer') --}}
    </div>
    {{--
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script> --}}

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
    </script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/slick/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/slick-custom.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/lightbox2/js/lightbox.min.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        $('.block2-btn-addcart').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to cart !", "success");
        });
    });

    $('.block2-btn-addwishlist').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");
        });
    });
    </script>

    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/parallax100/parallax100.js') }}"></script>
    <script type="text/javascript">
        $('.parallax100').parallax100();
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/wow.js') }}"></script>
    <!-- WhatsHelp.io widget -->
    {{--  <script type="text/javascript">
        (function () {
            var options = {
                facebook: "2463813797024649", // Facebook page ID
                whatsapp: "+254731090832", // WhatsApp number
                call_to_action: "Message us", // Call to action
                button_color: "#129BF4", // Color of button
                position: "left", // Position may be 'right' or 'left'
                order: "facebook,whatsapp", // Order of buttons
            };
            var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
            s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
            var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
        })();
    </script>  --}}
    <!-- /WhatsHelp.io widget -->
    <script type="text/javascript"> window.$crisp=[];window.CRISP_WEBSITE_ID="0f76d712-616b-4b79-b6cb-26db4575b205";(function(){ d=document;s=d.createElement("script"); s.src="https://client.crisp.chat/l.js"; s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})(); </script>

</body>

</html>
