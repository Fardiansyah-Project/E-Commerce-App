@include('admin.layouts.head')

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.layouts.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.layouts.navbar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">&copy; SneakerStore — All Rights Reserved {{ date('Y') }} </span>

                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Documentation Project <a
                                href="https://github.com/Fardiansyah-Project/E-Commerce-App" target="_blank">Repository Github </a> from github.com</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    @include('admin.layouts.script')
    @include('sweetalert::alert')
    <!-- End custom js for this page -->
</body>

</html>
