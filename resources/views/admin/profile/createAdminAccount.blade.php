@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-5 offset-3">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Create New Admin</h6>
                    </div>
                </div>
            </div>
            <div class="card-body ">
                <form action="{{ route('adminCreate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">New Admin Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Admin Name...">
                        @error('name')
                            <small class=" invalid-feedback">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">New Admin Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Admin Email...">
                        @error('email')
                            <small class=" invalid-feedback">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" >
                        @error('password')
                            <small class=" invalid-feedback">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror" name="confirmPassword" >
                        @error('confirmPassword')
                            <small class=" invalid-feedback">{{$message}}</small>
                        @enderror
                    </div>

                    <input type="submit" value="Create" class="btn btn-primary">
                    <a href="{{ route('adminDashboard') }}"><input type="button" class="btn btn-danger" value="Cancel"></a>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
