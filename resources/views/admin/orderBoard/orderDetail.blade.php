@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        @if ($backFun->status == '0')
            <a href="{{ route('orderBoardPage') }}"><i class="fa-solid fa-arrow-left"></i></a>
        @elseif ($backFun->status != '0')
            <a href="{{ route('saleInfo') }}"><i class="fa-solid fa-arrow-left"></i></a>
        @endif

        {{-- <a href="{{ route('orderBoardPage') }}"><i class="fa-solid fa-arrow-left"></i></a> --}}
        <div class=" card-body">
            <div class="row">
                <div class="col-3 ">
                    @if ( $paySlipData->payslip_image == null )
                        <h1 class=" text-danger-emphasis">No Pay Slip Image</h1>

                    @elseif ( $paySlipData->payslip_image != null)
                        <img style="width: 200px" class="img-thumbnail" src="{{ asset('paySlipImages/'.$paySlipData->payslip_image) }}" alt="">
                    @endif

                </div>
                <div class="col-7">
                    <div>Customer Name : {{ $paySlipData->customer_name }}</div>
                    <div>Customer Phone : {{ $paySlipData->phone }}</div>
                    <div>Payment Account Name : {{ $paySlipData->account_name }}</div>
                    <div>Order Code : {{ $paySlipData->order_code }}</div>
                    <div>Total Amount : {{ $paySlipData->order_amount }}</div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Product</th>
                                <th>Order Code</th>
                                <th>User</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetail as $item)
                                <tr>
                                    <td>{{ $item->created_at->format('j-F-y')}}</td>
                                    <td>{{ $item->productName }}</td>
                                    <td><a href="">{{ $item->order_code}}</a></td>
                                    @if ($item->userName != null)
                                        <td>{{ $item->userName}}</td>
                                     @else
                                        <td>{{ $item->userNickname}}</td>
                                    @endif


                                    <td>{{ $item->qty }}</td>

                                    <td>{{ $item->total_price }} MMK</td>
                                    <td>
                                        {{-- <select name="" id="">
                                            <option class="text-warning" value="0" @if($item->status==0) selected @endif>Pending</option>
                                            <option class="text-success" value="1" @if($item->status==1) selected @endif>Accept</option>
                                            <option class="text-danger" value="2" @if($item->status==2) selected @endif>Reject</option>
                                        </select> --}}
                                        @if ($item->status == 0)
                                            <h5 class="text-warning">Pending</h5>
                                        @elseif ($item->status == 1)
                                            <h5 class="text-success">Accepted</h5>
                                        @elseif ($item->status == 2)
                                            <h5 class="text-danger">Rejected</h5>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-center">Total</th>
                                <th colspan="2">{{ $totalPrice + 500 }} MMK
                                    <small class="text-danger mx-2 mb-3">(Included Delivery Fee 500MMK)</small>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    {{-- <span class="d-flex justify-content-end">{{ $data->links()}}</span> --}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
