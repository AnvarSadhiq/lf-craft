<!DOCTYPE html>
<html>

<!-- Heade css Start-->

<head>
    @include('admin.css')
</head>
<!-- Heade css end-->

<body>
    <!-- Header Section Start-->
    @include('admin.header')
    <!-- Header Section End-->

    <!-- Sidebar Navigation start-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->

    <!-- Body Section Start -->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                @include('admin.body')
            </div>
        </div>
        <!-- Body Section end -->

        <!-- JavaScript files-->
        <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"></script>
        <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"></script>
        <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
        <script src="{{asset('admincss/js/charts-home.js')}}"></script>
        <script src="{{asset('admincss/js/front.js')}}"></script>
</body>

</html>