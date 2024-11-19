@extends('user.layouts.master')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Ordered List</a></li>
            <li class="breadcrumb-item active text-white">Payment</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- DataTales Example -->
    <div class=" p-3 mx-5">
        <a href="{{ route('cartPage') }}" class="fs-5"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
    <div class="row">
        <div class="col-5 offset-1">
            <h3 class="mb-3">ငွေပေးချေမှုအချက်အလက်</h3>
            @foreach ($payment as $item)
            @if ( $item->type == 1  )
                <h5>Payment Type : KBZ Banking ({{ $item->account_name}})</h5>
            @elseif ( $item->type == 3  )
                <h5>Payment Type : AYA Banking ({{ $item->account_name}})</h5>
            @elseif ( $item->type == 2  )
                <h5>Payment Type : KPay ({{ $item->account_name}})</h5>
            @endif
                <h4>Account Number : {{ $item->account_number }}</h4>
                <hr>
            @endforeach
        </div>
        <div class="col-5">
            <form action="{{ route('payment') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-5 offset-1">
                        Name
                        <input type="hidden" class="form-control" name="customerName" value="{{ auth()->user()->name != null ? auth()->user()->name : auth()->user()->nickname }}">
                        <input type="text" class="form-control" disabled value="{{ auth()->user()->name != null ? auth()->user()->name : auth()->user()->nickname }}">
                    </div>
                    <div class="col-5">
                        Phone
                        <input type="text" class="form-control @error('customerPhone') is-invalid @enderror" value="{{ old('customerPhone') }}" name="customerPhone" placeholder="Phone">
                        @error('customerPhone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-10 offset-1">
                        Payment Slip Image
                        <img src="" class="img-thumbnail form-control" id="output">
                        <input type="file" class="form-control @error('paySlipImage') is-invalid @enderror" name="paySlipImage" onchange="loadFile(event)">
                        @error('paySlipImage')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-10 offset-1">
                        Choose Payment Type
                        <select class="form-control @error('paymentType') is-invalid @enderror" name="paymentType">
                                    <option class="form-control" value="">Choose payment type....</option>
                            @foreach ($payment as $item)
                                @if ($item->type == 1)
                                    <option class="form-control" value="1">KBZ Banking</option>
                                @elseif ($item->type == 2)
                                <option class="form-control" value="2">KPay</option>
                                @elseif ($item->type == 3)
                                    <option class="form-control" value="3">AYA Banking</option>
                                @endif
                            @endforeach
                        </select>
                        @error('paymentType')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-5 offset-1">
                        Order Code
                        <input type="hidden" value="{{ $cartProduct[0]['order_code'] }}" class="form-control" name="orderCode">
                        <input type="text" disabled value="{{ $cartProduct[0]['order_code'] }}" class="form-control">
                    </div>
                    <div class="col-5">
                        Order Amount
                        <input type="hidden" value="{{ $totalPrice + 500 }}MMK" class="form-control" name="totalPrice">
                        <input type="text" disabled value="{{ $totalPrice + 500 }}MMK" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-10 offset-1">
                        <input type="submit" class="form-control btn btn-primary" value="Order">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- /.container-fluid -->
@endsection
