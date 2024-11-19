@extends('user.layouts.master')

@section('content')

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Cart</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Cart</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                          <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Remove from Cart</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)

                            <tr>
                                <input type="hidden" value="{{ $item->id }}" class="cartID">
                                <input type="hidden" value="{{ $item->productID }}" class="productId">
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('uploads/'.$item->image) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item->name}}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" id="price">{{ $item->price}} MMK</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0" id="qty" value="{{ $item->qty }}">
                                        <div class="input-group-btn" >
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" id="eachTotal">{{ $item->price * $item->qty }} MMK</p>
                                </td>
                                <td>
                                    <input type="hidden" value="{{ $item->id }}" id="cartId">
                                    <div class="input-group-btn" >
                                        <button class="btn btn-sm btn-remove rounded-circle bg-light border">
                                            <i class="fa-solid fa-square-minus fs-3"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Subtotal:</h5>
                                    <p class="mb-0" id="subTotal">{{ $subTotal}} MMK</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Shipping</h5>
                                    <div class="">
                                        <p class="mb-0">500 MMK</p>
                                    </div>
                                </div>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <p class="mb-0 pe-4" id="finalFee">{{ $subTotal + 500 }} MMK</p>
                            </div>

                            <input type="hidden" value="{{ auth()->user()->id }}" id="userId">
                            <button id="proceedBtn" @if (count($cart)== 0)
                                disabled
                            @endif class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Page End -->

@endsection

@section('js-section')

<script>
    $(document).ready(function(){

            // button နှိပ်တဲ့အခါ console မှာကြည့်
            // $('.btn-minus').click(function(){
            //     console.log("btn minus clicked");
            // })

            // when click minus button
            $('.btn-plus').click(function(){
                $parentNode = $(this).parents("tr");
                $price = $parentNode.find("#price").text().replace("MMK","");
                $qty = $parentNode.find("#qty").val();
                $totalprice = $price * $qty;
                $parentNode.find("#eachTotal").html($totalprice + "MMK");
                finalCalculation();
                // console.log($totalprice);
            })

            // when click plus button
            $('.btn-minus').click(function(){
                $parentNode = $(this).parents("tr");
                $price = $parentNode.find("#price").text().replace("MMK","");
                $qty = $parentNode.find("#qty").val();
                $totalprice = $price * $qty;
                $parentNode.find("#eachTotal").html($totalprice + "MMK");
                finalCalculation();
            })

            // when click remove button
            $(".btn-remove").click(function(){
                $parentNode = $(this).parents("tr");
                $cartId = $parentNode.find("#cartId").val();

                $deleteData = {
                    'cartId' : $cartId
                };

                $.ajax({
                    type : 'get' ,
                    url : 'cartPage/removeCart' ,
                    data : $deleteData ,
                    dataType : 'json' ,
                    success : function(response){
                        // console.log(response);
                        if (response.message == 'success'){
                            location.reload();
                        }
                    }
                });

            })

            function finalCalculation(){
                $totalPrice = 0;
                $("#dataTable tbody tr").each(function( item,row){
                    $totalPrice += Number($(row).find("#eachTotal").text().replace("MMK",""));
                    $("#subTotal").html(`${$totalPrice} MMK`);
                    $("#finalFee").html(`${$totalPrice + 500} MMK`);
                    // console.log($totalPrice);
                })
            }

            // proceed checkout
            $('#proceedBtn').click(function(){

                $orderList = [];
                $orderCode = Math.floor(Math.random() * 10000000);
                $userId = $('#userId').val();
                // $totalPrice = $('#eachTotal').text().replace("MMK","") * 1; (priceအားလုံးပေါင်း)

                $("#dataTable tbody tr").each(function( item , row ){
                    // console.log(row);
                    $productId = $(row).find('.productId').val() * 1;
                    $cartId = $(row).find('.cartID').val() * 1;
                    $totalPrice = $(row).find('#eachTotal').text().replace("MMK","") * 1;
                    $qty = $(row).find('#qty').val() * 1;
                    // console.log($productId);
                    $orderList.push({
                        'user_id' : $userId ,
                        'product_id' : $productId ,
                        'order_code' : 'POS' + $orderCode ,
                        'total_price' : $totalPrice ,
                        'cartId' : $cartId ,
                        'qty' : $qty
                    })
                    // console.log($orderList);
                })

                $.ajax({
                    type : 'get' ,
                    url : 'order' ,
                    data : Object.assign({},$orderList) ,
                    dataType : 'json' ,
                    success : function(response){
                        // console.log(response);
                        if (response.message == 'success'){
                            // location.reload();
                            location.href = "paymentPage"
                        }

                    }
                });
                // console.log("success");
            })

    })
</script>

@endsection
