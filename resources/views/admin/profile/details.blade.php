@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <form action="{{ route('profileUpdate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 p-3">
                            <div class="mx-2">
                                <label class="form-label">Image</label>
                                <input type="hidden" value="{{ auth()->user()->profile }}" name="oldImage">
                                @if (auth()->user()->profile == null)
                                    <img class="img-thumbnail" id="output" src="{{ asset('/admin/defaultphoto/default.jpg') }}" alt="">
                                @else
                                    <img class="img-thumbnail" id="output" src="{{ asset('/admin/profile_photo/'.auth()->user()->profile) }}">
                                @endif

                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" onchange="loadFile(event)">
                                @error('image')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-lg">
                            <div class="row">
                                <div class="col-lg-8 mb-3">
                                    {{-- @if (auth()->user()->provider == 'simple')
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name',auth()->user()->name == null ? auth()->user()->nickname : auth()->user()->name) }}" placeholder="Admin Name">
                                    @else
                                        <input type="text" class="form-control">
                                    @endif --}}
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name',auth()->user()->name == null ? auth()->user()->nickname : auth()->user()->name) }}"
                                        @if (auth()->user()->provider != 'simple')
                                            disabled
                                        @endif placeholder="Admin Name">
                                    @error('name')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-lg-4 mb-3 ">
                                    <label  class="form-label">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" @if (auth()->user()->provider!='simple')
                                        disabled
                                    @endif name="email" value="{{ old('email',auth()->user()->email) }}" placeholder="Admin Email">
                                    @error('email')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3 mx-2">
                                    <label  class="form-label">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone',auth()->user()->phone) }}" placeholder="Admin phone">
                                    @error('phone')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-lg-4 mb-3 ">
                                    <label  class="form-label">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address',auth()->user()->address) }}" placeholder="Admin address">
                                    @error('address')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            @if (auth()->user()->provider == 'simple')
                                <a href="{{ route('changePasswordPage') }}">Change password</a>
                            @endif

                            <div class="row p-2">
                                <div class="col-lg">
                                    <input type="submit" value="Update" class="btn btn-danger p-2">
                                    <a href="{{ route('adminDashboard') }}"><input type="button" value="Back" class="btn btn-primary p-2"></a>
                                </div>
                            </div>

                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
