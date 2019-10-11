<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" href="/storage/icons/favicon.png" />
    <!-- Scripts -->
    <!-- Fonts -->
    <link href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slide.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('mdBootstrap/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('mdBootstrap/css/mdb.css') }}" rel="stylesheet">
    <link href="{{ asset('mdBootstrap/css/mdb.lite.min.css') }}" rel="stylesheet">
    {{--
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{--
    <script src="{{ asset('js/wow.js') }}"></script> --}}
    <script src="{{ asset('mdBootstrap/js/mdb.min.js') }}" defer></script>
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
