<!DOCTYPE html>
<html>

<!-- Heade css Start-->

<head>
    @include('admin.css')

    <style type="text/css">
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        .table_deg {
            border: 2px solid greenyellow;
        }

        th {
            border: 1px solid;
            background-color: lightblue;
            color: white;
            font-size: 19px;
            font-weight: bold;
            padding: 15px;
        }

        td {
            border: 1px solid lightblue;
            text-align: center;
            color: white;

        }

        input[type='search']{
            width: 500px;
            height: 60px;
            margin-left: 50px;
        }
    </style>
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

            <form action="{{url('product_search')}}" method="get">
                @csrf
                <input type="search" name="search">
                <input class="btn btn-secondary" type="submit" value="Search">
            </form>

                <div class="div_deg">
                    <table class="table_deg">
                        <tr>
                            <th>Product Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>delete</th>
                        </tr>

                        @foreach ($product as $product)

                        <tr>
                            <td>{{$product->title}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->category}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>
                                <img height="120" width="120" src="products/{{$product->image}}">
                            </td>

                            <td>
                                <a class="btn btn-success" onclick="editConfirmation(event)" href="{{url('edit_product',$product->id)}}">Edit</a>
                            </td>

                            <td>
                                <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_product',$product->id)}}">Delete</a>
                            </td>
                        </tr>

                        @endforeach
                    </table>
                </div>

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