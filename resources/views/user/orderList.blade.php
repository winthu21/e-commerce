@extends('user.layouts.master')

@section('content')

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Cart</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Ordered List</li>
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
                            <th scope="col">Date</th>
                            <th scope="col">Order Code</th>
                            <th scope="col">Status</th>
                            <th scope="col">Total Price</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderList as $item)
                                <tr>
                                    <td>{{ $item->created_at->format('j-F-y')}}</td>
                                    <td><a href="{{ route('orderDetail',$item->order_code) }}">{{ $item->order_code}}</a></td>
                                    <td>
                                        @if ($item->status == 0)
                                            <p class="text-warning">Pending</p>
                                        @elseif ($item->status == 1)
                                            <p class="text-success">Success</p>
                                        @elseif ($item->status == 2)
                                            <p class="text-danger">Reject</p>
                                        @endif
                                    </td>
                                    <td>{{ $item->total_amount + 500 }} MMK
                                        <div>
                                            <small class="text-danger">Included Delivery Fee 500</small>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Cart Page End -->

@endsection

@section('js-section')

<script>

</script>

@endsection
