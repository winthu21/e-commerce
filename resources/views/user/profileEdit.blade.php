@extends('user.layouts.master')

@section('content')

    <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Cart</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('userHome') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Edit Profile</a></li>
            </ol>
        </div>
    <!-- Single Page Header End -->

    <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mt-3">
                <div class="card-header py-3">
                    <div class="">
                        <div class="">
                            <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                        <div class="row">
                            <form action="{{ route('profileUpdate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 offset-2 p-3">
                                    <div class="mx-2">
                                        <label class="form-label">Image</label>
                                        <input type="hidden" value="{{ auth()->user()->profile }}" name="oldImage">
                                        @if (auth()->user()->profile == null)
                                            <img class="img-thumbnail" class="form-control" id="output" src="{{ asset('/admin/defaultphoto/default.jpg') }}" alt="">
                                        @else
                                            <img class="img-thumbnail" class="form-control" id="output" src="{{ asset('/user/profile_photo/'.auth()->user()->profile) }}">
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
                                            @if (auth()->user()->provider == 'simple')
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
                                            @error('email')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                            @else
                                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                                            @endif

                                        </div>
                                        <div class="col-lg-4 mb-3 mx-2">
                                            <label  class="form-label">Phone</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone',$user->phone) }}">
                                            @error('phone')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="col-lg-4 mb-3 ">
                                            <label  class="form-label">Address</label>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address',$user->address) }}">
                                            @error('address')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                    </div>

                                    <div class="row ">
                                        <div class="col-lg-4 mb-3 ">
                                            <label  class="form-label">Role</label>
                                            <input type="text" class="form-control" value="{{ $user->role }}" disabled>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-2">
                                            <input type="submit" class="btn btn-primary form-control" value="Update">
                                        </div>
                                        <div class="col-lg-2">
                                            <a href="{{ route('profilePage') }}"><input type="button" class="btn btn-outline-danger form-control" value="Cancel"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    <!-- /.container-fluid -->

@endsection

@section('js-section')
<script>
    function loadFile(event){
        var reader= new FileReader();

        reader.onload = function(){
            var output = document.getElementById('output');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0])
    }
</script>
@endsection

