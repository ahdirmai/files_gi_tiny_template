<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>@yield('title')- Files Guru Inovatif</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('css/simplebar.css')}}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.min.js" defer></script>
    <!-- Icons CSS -->
    @livewireStyles()

    <link rel="stylesheet" href="{{ asset('css/feather.css')}}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css')}}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app-light.css')}}" id="lightTheme">

    <link rel="stylesheet" href="{{ asset('css/app-dark.css')}}" id="darkTheme" disabled>
    @stack('styles')
</head>

<body class="vertical light  ">
    <div class="wrapper">
        {{-- Header --}}
        {{-- @include('components.layout.header'); --}}
        <livewire:component.header></livewire:component.header>
        {{-- End Header --}}

        {{-- SideBar --}}
        @include('components.layout.sidebar')
        {{-- End Sidebar --}}

        {{-- Main --}}
        @yield('content')
        <!-- main -->


    </div>




    @livewireScripts()
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/popper.min.js')}}"></script>
    <script src="{{ asset('js/moment.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/simplebar.min.js')}}"></script>
    <script src="{{ asset('js/daterangepicker.js')}}"></script>
    <script src="{{ asset('js/jquery.stickOnScroll.js')}}"></script>
    <script src="{{ asset('js/tinycolor-min.js')}}"></script>
    <script src="{{ asset('js/config.js')}}"></script>
    <script src="{{ asset('js/d3.min.js')}}"></script>
    <script src="{{ asset('js/topojson.min.js')}}"></script>
    <script src="{{ asset('js/datamaps.all.min.js')}}"></script>
    <script src="{{ asset('js/datamaps-zoomto.js')}}"></script>
    <script src="{{ asset('js/datamaps.custom.js')}}"></script>
    {{-- <script src="{{ asset('js/Chart.min.js')}}"></script> --}}
    {{-- <script>
        Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
        Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script> --}}
    <script src="{{ asset('js/gauge.min.js')}}"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js')}}"></script>
    <script src="{{ asset('js/apps.js')}}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-56159088-1');
    </script>

    <script>
        window.addEventListener('show-form',event=>{
            $('#basic-modal').modal('show');
        });

        window.addEventListener('show-version',event=>{
            console.log('disini');
            $('#version-modal').modal('show');
        });

    window.addEventListener('hide-form',event=>{
        $('#basic-modal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    })


    window.addEventListener('show-side',event=>{
        $('#modal-side').modal('show');
        })


    window.addEventListener('hide-side',event=>{
        $('#modal-side').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    })

    // jQuery(document).ready(function($) {
    //         $("#basic-modal").on("hide.bs.modal", (event) => {
    //             console.log('hidden');
    //         });

    //     });






    </script>

    <script>
        function myFunction() {
  // Get the text field
  var copyText = document.getElementById("url");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);

  // Alert the copied text
  alert("Link Copied");
}


    </script>

    @stack('scripts')




</body>

</html>
