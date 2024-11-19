@extends('user.layouts.master')

@section('content')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('userHome') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Change Password</a></li>
    </ol>
</div>

<!-- Single Page Header End -->
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mt-3 mb-3 col-6 offset-3">
            <div class="card-body ">
                <form action="{{ route('changeUserPsw') }}" method="POST">
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
                    <a href="{{ route('profilePage') }}">
                        <input type="button" value="Cancel" class="btn btn-danger">
                    </a>
                </form>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
