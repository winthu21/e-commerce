@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Order Code</th>
                                <th>User</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderList as $item)
                                <tr>
                                    <input type="hidden" name="orderCode" class="orderCode" value="{{ $item->order_code }}">
                                    <td>{{ $item->created_at->format('j-F-y')}}</td>
                                    <td class="orderCode"><a href="{{ route('orderDetails',$item->order_code) }}">{{ $item->order_code}}</a></td>
                                    @if ($item->userName != null)
                                        <td>{{ $item->userName}}</td>
                                     @else
                                        <td>{{ $item->userNickname}}</td>
                                    @endif
                                    <td><select name="status" class="form-control statusChange" id="">
                                        <option class="text-warning" value="0" @if($item->status==0) selected @endif>Pending</option>
                                        <option class="text-success" value="1" @if($item->status==1) selected @endif>Accept</option>
                                        <option class="text-danger" value="2" @if($item->status==2) selected @endif>Reject</option>
                                    </select></td>
                                </tr>
                            @endforeach

                            <span class=" d-flex justify-content-end">{{ $orderList->links() }}</span>
                        </tbody>
                    </table>
                    {{-- <span class="d-flex justify-content-end">{{ $data->links()}}</span> --}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('js-content')
    <script>
        $(document).ready(function(){
            $('.statusChange').change(function(){
                // console.log("change event");
                $currentState = $(this).val();
                $orderCode = $(this).parents("tr").find(".orderCode").val();
                $data = {
                    'status' : $currentState,
                    'orderCode' : $orderCode
                };
                // console.log($data);

                $.ajax({
                    type : 'get',
                    url : 'orderStatusChange',
                    data : $data,
                    dataType : 'json'
                })
            })
        })
    </script>
@endsection
