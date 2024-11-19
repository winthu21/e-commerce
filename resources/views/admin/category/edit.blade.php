@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-5">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Update Category Page</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('categoryUpdate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                        <input type="hidden" name="categoryID" value="{{ $data->id }}" id="">
                        <input type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category',$data->name) }}" placeholder="Category Name">
                        @error('category')
                            <small class=" invalid-feedback">{{$message}}</small>
                        @enderror
                    </div>

                    <input type="submit" value="Create" class="btn btn-primary">
                    <a href="{{ route('categoryList') }}"><input type="button" value="Cancel" class="btn btn-danger"></a>

                </form>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
