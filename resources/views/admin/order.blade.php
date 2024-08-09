<!DOCTYPE html>
<html>

<head>
    @include('admin.css')

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        .order-page-header {
            padding: 20px 15px;
            background-color: white;
            color: #8a8d93;
            margin-bottom: 30px;
        }

        table {
            border-collapse: collapse;
            /* Collapses borders for a cleaner look */
            width: 100%;
            /* Makes table responsive */
            max-width: 100%;
            /* Ensures table does not overflow the container */
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            /* Light border for table cells */
        }

        th {
            background-color: lightseagreen;
            /* Updated background color */
            color: white;
            /* Ensures text color contrasts well */
            font-size: 18px;
            font-weight: bold;
        }

        td {
            color: white;
        }

        .table_center {
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: auto;
            /* Enables horizontal scrolling on small screens */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            table {
                font-size: 14px;
                /* Reduces font size on smaller screens */
            }

            th,
            td {
                padding: 8px;
                /* Reduces padding for smaller screens */
            }

            /* Stack table headers and data vertically for very small screens */
            .table_center {
                display: block;
                overflow-x: auto;
            }

            table {
                width: 100%;
                display: block;
                overflow-x: auto;
                white-space: nowrap;
                /* Prevents wrapping of table contents */
            }

            th,
            td {
                display: block;
                width: 100%;
                box-sizing: border-box;
                text-align: left;
                /* Align text to left */
                padding-left: 50%;
                /* Add padding for labels */
            }

            th::before,
            td::before {
                content: attr(data-label);
                /* Use data-label for table headers */
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 10px;
                font-weight: bold;
                text-align: left;
                /* Align text to left */
            }
        }
    </style>
</head>

<body>
    <!-- Header Section Start -->
    @include('admin.header')
    <!-- Header Section End -->

    <!-- Sidebar Navigation Start -->
    @include('admin.sidebar')
    <!-- Sidebar Navigation End -->

    <!-- Body Section Start -->
    <div class="container-fluid mt-4">
        <div class="order-page-header">
            <h3>All Orders</h3>
            <br>
            <div class="table_center">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Product Title</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Change Status</th>
                            </tr>
                        </thead>
                        <tbody style="background:#8a8d93">
                            @foreach ($data as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td class="text-nowrap">{{$item->rec_address}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->product->title}}</td>
                                <td>${{$item->product->price}}</td>
                                <td>
                                    <img width="150" src="products/{{$item->product->image}}" alt="Product Image" class="img-fluid">
                                </td>
                                <td>{{$item->payment_status}}</td>
                                <td>
                                    @if ($item->status == 'in progress')
                                    <span class="text-danger">{{$item->status}}</span>
                                    @elseif ($item->status == 'on the way')
                                    <span class="text-warning">{{$item->status}}</span>
                                    @else
                                    <span class="text-success">{{$item->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{url('on_the_way',$item->id)}}">On the Way</a>
                                    <a class="btn btn-success btn-sm" href="{{url('delivered',$item->id)}}">Delivered</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Body Section End -->

    <!-- JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
