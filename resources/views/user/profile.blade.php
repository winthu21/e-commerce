@extends('user.layouts.master')

@section('content')

    <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Cart</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('userHome') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">My Profile</a></li>
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
                            <div class="col-lg-4 offset-2 p-3">
                                <div class="mx-2">
                                    <label class="form-label">Image</label>
                                    @if ($user->profile == null)
                                        <img class="img-thumbnail w-75" src="{{ asset('admin/defaultphoto/default.jpg')}}" alt="">
                                    @else
                                        <img class="img-thumbnail w-75" src="{{ asset('user/profile_photo/'.$user->profile) }}" alt="">
                                    @endif
                                </div>

                            </div>
                            <div class="col-lg">
                                <div class="row">
                                    <div class="col-lg-8 mb-3">

                                        <label class="form-label">Name</label>
                                        @if ($user->name != null)
                                            <input type="text" class="form-control" disabled value="{{ $user->name }}">
                                        @elseif ($user->name == null)
                                            <input type="text" class="form-control" disabled value="{{ $user->nickname }}">
                                        @endif

                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col-lg-4 mb-3 ">
                                        <label  class="form-label">Email</label>
                                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                                    </div>
                                    <div class="col-lg-4 mb-3 mx-2">
                                        <label  class="form-label">Phone</label>
                                        <input type="text" class="form-control" value="{{ $user->phone }}" disabled>
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col-lg-4 mb-3 ">
                                        <label  class="form-label">Address</label>
                                        <input type="text" class="form-control" value="{{ $user->address }}" disabled>
                                </div>

                                <div class="row ">
                                    <div class="col-lg-4 mb-3 ">
                                        <label  class="form-label">Role</label>
                                        <input type="text" class="form-control" value="{{ $user->role }}" disabled>
                                </div>

                                @if (auth()->user()->provider == 'simple')
                                    <div class="row mb-3 ">
                                        <div class="col-lg-4">
                                            <a href="{{ route('changeUserPswPage') }}"><input type="button" class="btn btn-outline-primary form-control" value="Change Password"></a>
                                        </div>
                                    </div>
                                @endif


                                <div class="row">
                                    <div class="col-lg-2">
                                        <a href="{{ route('profileEditPage') }}"><input type="button" class="btn btn-primary form-control" value="Edit"></a>

                                    </div>
                                    <div class="col-lg-2">
                                        <a href="{{ route('userHome') }}"><input type="button" class="btn btn-secondary form-control" value="Home"></a>
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

