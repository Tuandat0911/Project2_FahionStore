<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @yield('title')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('eshopper/eshopper/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('eshopper/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('eshopper/css/style.css') }}" rel="stylesheet">
</head>

<body>
<!-- Topbar Start -->
<div class="container-fluid">
    @include('component_guest_layout.header')
    @include('component_guest_layout.navbar')
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        @include('component_guest_layout.categories')
        <div class="col-lg-9">
            @include('component_guest_layout.directional')
            @include('component_guest_layout.slider')
        </div>
    </div>
</div>
<!-- Navbar End -->


@yield('content')


<!-- Footer Start -->
@include('component_guest_layout.footer')
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('eshopper/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('eshopper/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Contact Javascript File -->
<script src="{{ asset('eshopper/mail/jqBootstrapValidation.min.js') }}"></script>
<script src="{{ asset('eshopper/mail/contact.js') }}"></script>
<script src="{{ asset('eshopper/mail/contact.js') }}"></script>
<script>
    setInterval(function() {
        location.reload();
    }, 1000000);
</script>

<!-- Template Javascript -->
</body>

</html>
