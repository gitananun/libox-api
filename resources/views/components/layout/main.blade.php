<!doctype html>
<html lang="en">

<x-layout.head />

<body>

    <x-layout.header>
        {{ $header ?? null }}
    </x-layout.header>

    <x-modals.login-signup />

    {{ $slot }}

    <x-layout.footer />

    <x-go-to-top />

    <!-- JavaScript -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.meanmenu.min.js"></script>
    <script src="js/wow.min.js"></script>
    <!-- Counter Script -->
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>
