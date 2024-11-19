@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-5 offset-3">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Add Category Page</h6>
                    </div>
                </div>
            </div>
            <div class="card-body ">
                <form action="{{ route('changePassword') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Old Password</label>
                        <input type="password" class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword" value="">
                            @error('oldPassword')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        <hr>
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control @error('newPassword') is-invalid @enderror" name="newPassword" value="">
                        @error('newPassword')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        <hr>
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror" name="confirmPassword" value="">
                        @error('confirmPassword')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>

                    <input type="submit" value="Create" class="btn btn-primary">
                    <input type="button" value="Cancel" class="btn btn-danger">
                </form>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
