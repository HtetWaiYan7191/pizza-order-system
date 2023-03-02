@extends('user.layout.master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Pizzas</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $c)
                            <tr>
                                <td class="align-middle"><img src="{{ asset('storage/' . $c->pizza_image) }}"
                                        class=" img-thumbnail" alt="" style="width: 100px;"></td>
                                <td class="align-middle">
                                    {{ $c->pizza_name }}</td>
                                <input type="hidden" name="" id="orderId" value="{{ $c->id}}">
                                <input type="hidden" id="productId" value="{{ $c->product_id }}">
                                <input type="hidden" id="userId" value="{{ $c->user_id }}">
                                <td class="align-middle col-3"id="pizzaPrice">{{ $c->pizza_price }} Kyats</td>
                                {{-- <input type="hidden" name="" value="{{$c->pizza_price}}" id="pizzaPrice"> --}}
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $c->quantity }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $c->pizza_price * $c->quantity }} Kyats</td>
                                <td class="align-middle btnRemove"><button class="btn btn-sm btn-danger"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{ $totalPrice }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotal">{{ $totalPrice + 3000 }}</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed To
                            Checkout</button>

                        <button class="btn btn-block bg-danger text-white font-weight-bold my-3 py-3" id="clearBtn">Clear
                            Cart</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        $('#orderBtn').click(function() {
            $orderList = [];
            $random = Math.floor(Math.random() * 100000) + 1;


            $('#dataTable tbody tr').each(function(index, row) {

                $orderList.push({
                    'user_id': $(row).find('#userId').val(),
                    'product_id': $(row).find('#productId').val(),
                    'qty': $(row).find('#qty').val(),
                    'total': $(row).find('#total').text().replace('Kyats', '') * 1,
                    'order_code': "POS" + $random,
                });
            });

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/order',
                data: Object.assign({}, $orderList),
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'true') {
                        window.location.href = 'http://127.0.0.1:8000/user/homePage';
                    }
                }
            })



        })

        $('#clearBtn').click(function() {

            $('#dataTable tbody tr').remove();
            $('#subTotalPrice').html("0 Kyats");
            $('#finalTotal').html('0 Kyats');

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/clear/cart',
                dataType: 'json',

            })
        })

        //REMOVE CURRENT PRODUCT IN CART

        $('.btnRemove').click(function() {
            //remove button click
            $parentNode = $(this).parents("tr");
            $productId = $parentNode.find('#productId').val();
            $orderId = $parentNode.find('#orderId').val();
            console.log($productId,$orderId);

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/clear/current/product',
                data: {'productId' : $productId, ' orderId' : $orderId},
                dataType: 'json',


            })

            $parentNode.remove();
            $totalPrice = 0;
            $('#dataTable tbody tr').each(function(index, row) {
                $totalPrice += Number($(row).find('#total').text().replace("Kyats", ""));

            })

            $('#subTotalPrice').html(`${$totalPrice} Kyats`);
            $('#finalTotal').html(`${$totalPrice + 3000} Kyats`);


        })
    </script>
@endsection
