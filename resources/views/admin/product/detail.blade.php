@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                    <div class="row">
                        <div class="col-lg-4 p-3">
                            <div class="mx-2">
                                <label class="form-label">Image</label>
                                <img class="img-thumbnail" id="output" src="{{ asset('/uploads/'.$data->image)}}" alt="">
                            </div>

                        </div>
                        <div class="col-lg">
                            <div class="row">
                                <div class="col-lg-8 mb-3">
                                    <label class="form-label">Name</label>
                                    <h4>{{ $data->name }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 mb-3">
                                    <label class="form-label">Category</label>
                                    <h4>{{ $data->categoryName }}</h4>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-lg-4 mb-3 ">
                                    <label  class="form-label">Price</label>
                                    <h4>{{ $data->price }} MMK</h4>
                                </div>
                                <div class="col-lg-4 mb-3 mx-2">
                                    <label  class="form-label">Units</label>
                                    <h4>{{ $data->count }} items</h4>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-lg-8">
                                    <label class="form-label">Product Description</label>
                                    <h4>{{ $data->description }}</h4>
                                </div>

                            </div>
                            <div class="row p-2">
                                <div class="col-lg">
                                    <a href="{{ route('productList') }}"><input type="btn" value="Back" class="btn btn-primary p-2"></a>
                                </div>

                            </div>

                        </div>
                    </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
