<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }

        table {
            border: 2px solid black;
            text-align: center;
            width: 100%;
            max-width: 800px;
            border-collapse: collapse;
            /* Optional: removes double borders */
        }

        th {
            border: 2px solid black;
            text-align: center;
            color: white;
            font-size: 20px;
            /* Corrected font size */
            font-weight: bold;
            background-color: black;
        }

        td {
            border: 2px solid black;
        }

        .cart_value {
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }

        .order_deg {
            padding-right: 100px;
            margin-top: 10px;
        }

        label {
            display: inline-block;
            width: 150px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            /* Adjust height as needed */
        }

        .div_gap {
            padding: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .order_deg {
                padding-right: 20px;
                /* Adjust padding for smaller screens */
                margin-top: 10px;
            }

            table {
                font-size: 14px;
                /* Reduce font size for smaller screens */
                width: 100%;
                /* Make table full width */
            }

            th,
            td {
                padding: 8px;
                /* Reduce padding in table cells */
            }

            label {
                display: block;
                /* Stack labels and inputs vertically */
                width: auto;
                /* Allow labels to use available space */
            }
        }

        @media (max-width: 480px) {
            .div_deg {
                flex-direction: column;
                /* Stack elements vertically */
                margin: 20px;
                /* Reduce margin */
            }

            .order_deg {
                padding-right: 0;
                /* Remove right padding */
                margin-top: 20px;
                /* Adjust margin */
            }

            .div_gap {
                padding: 10px;
                /* Reduce padding */
            }

            .cart_value {
                margin-bottom: 30px;
                /* Adjust margin */
                padding: 10px;
                /* Adjust padding */
            }
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section starts -->
        @include('home.header')
        <!-- end header section -->
    </div>

    <div class="div_deg">


        <table>
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                @php
                $value = 0;
                @endphp

                @foreach ($cart as $item)
                <tr>
                    <td>{{ $item->product->title }}</td>
                    <td>${{ $item->product->price }}</td>
                    <td>
                        <img width="150" src="/products/{{ $item->product->image }}" alt="{{ $item->product->title }}">
                    </td>
                    <td>
                        <a class="btn btn-danger" href="{{ url('delete_cart', $item->id) }}">Remove</a>
                    </td>
                </tr>
                @php
                $value += $item->product->price;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="cart_value">
        <h3>Total Value of Cart is: ${{ $value }}</h3>
    </div>

    <div class="order_deg" style="display:flex; justify-content:center; align-items:center;">
        <form action="{{url('confirm_order')}}" method="post">
            @csrf
            <div class="div_gap">
                <label for="name">Receiver Name</label>
                <input type="text" name="name" value="{{Auth::user()->name}}">
            </div>

            <div class="div_gap">
                <label for="phone">Receiver Address</label>
                <textarea name="address">{{Auth::user()->address}}</textarea>
            </div>

            <div class="div_gap">
                <label for="phone">Receiver Phone</label>
                <input type="text" name="phone" value="{{Auth::user()->phone}}">
            </div>

            <div class="div_gap">

                <input class="btn btn-primary" type="submit" value="Cash on Delivery">
                <a class="btn btn-success" href="{{url('stripe',$value)}}">Pay Using Card</a>
            </div>
        </form>
    </div>

    <!-- footer section -->
    @include('home.footer')
    <!-- end footer section -->

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>