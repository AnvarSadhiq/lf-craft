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
            margin: 60px;
        }

        label {
            display: inline-block;
            width: 200px;
            padding: 15px;
        }

        textarea {
            width: 400px;
            height: 80px;
        }

        input[type='text'] {
            width: 400px;
            height: 50px;
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
                <h1 style="color:white">Update Product</h1>

                <div class="div_deg">

                    <form action="{{url('update_product',$product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label>Title</label>
                            <input type="text" name="title" value="{{$product->title}}">
                        </div>

                        <div>
                            <label>Description</label>
                            <textarea name="description">{{$product->description}}</textarea>
                        </div>

                        <div>
                            <label>Price</label>
                            <input type="number" name="price" value="{{$product->price}}">
                        </div>

                        <div>
                            <label>Category</label>
                            <select name="category">
                                <!-- <option value="{{$product->category}}">{{$product->category}}</option> -->

                                @foreach ($category as $category)

                                <option value="{{$category->category_name}}">{{$category->category_name}}</option>

                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label>Quantity</label>
                            <input type="number" name="quantity" value="{{$product->quantity}}">
                        </div>

                        <div>
                            <label>Current Image</label>
                            <img width="100" height="100" src="/products/{{$product->image}}">
                        </div>

                        <div>
                            <label>New Image</label>
                            <input type="file" name="image">
                        </div>

                        <input class="btn btn-secondary" type="submit" value="Update">
                    </form>


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