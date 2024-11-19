@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                    </div>
                    <div class="">
                        <a href="{{ route('categoryCreate') }}"><i class="fa-solid fa-plus"></i> Add Category</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class=" text-center">
                                <th>ID</th>
                                <th>Category</th>
                                <th>Created_at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        @foreach ($data as $item)
                        <tbody>
                            <tr class=" text-center">
                                <td>{{ $item->id}}</td>
                                <td>{{ $item->name}}</td>
                                <td>{{ $item->created_at}}</td>
                                <td><a href="{{ route( 'categoryEdit',$item->id ) }}"><i class="fa-solid fa-pen-to-square "></i></a></td>
                                <td><a href="{{ route( 'categoryDelete',$item->id ) }}"><i class="fa-solid fa-trash-can text-danger text-center"></i></i></a></td>

                            </tr>


                        </tbody>
                        @endforeach

                    </table>

                </div>
                <span>{{ $data->links() }}</span>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
