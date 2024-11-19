@extends('user.layouts.master')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Ordered List</a></li>
            <li class="breadcrumb-item active text-white">Order Detail</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- DataTales Example -->
    <div class=" p-3 mx-5">
        <a href="{{ route('orderList') }}" class="fs-5"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
    <div class="card shadow mb-4 mx-3">
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Order Code</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderDetail as $item)
                            <tr>
                                <td>{{ $item->created_at->format('j-F-y')}}</td>
                                <td>
                                    <img src="{{ asset('uploads/'.$item->image) }}" class=" img-profile" style="height: 150px" alt="">
                                </td>
                                <td>{{ $item->productName }}</td>
                                <td><a href="">{{ $item->order_code}}</a></td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->total_price }}</td>
                                <td>
                                    @if ($item->status == 0)
                                        <p class="text-warning">Pending</p>
                                    @elseif ($item->status == 1)
                                        <p class="text-success">Success</p>
                                    @elseif ($item->status == 2)
                                        <p class="text-danger">Reject</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-center">Total</th>
                            <th colspan="2">{{ $total + 500 }} MMK
                                <small class="text-danger mx-2 mb-3">Included Delivery Fee (500)</small>
                            </th>
                        </tr>
                    </tfoot>
                </table>
                {{-- <span class="d-flex justify-content-end">{{ $data->links()}}</span> --}}
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
