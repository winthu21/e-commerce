@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <a href="{{ route('adminListPage') }}"><i class="fa-solid fa-left-long"></i>   Back</a>
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
                    <div class="row">
                        <div class="col-lg-4 p-3">
                            <div class="mx-2">
                                <label class="form-label">Image</label>
                                @if ($adminProfile->profile == null)
                                    <img style="height: 150px" class="img-thumbnail" src="{{ asset('admin/defaultphoto/default.jpg')}}" alt="">
                                @else
                                    @if ($adminProfile->role == 'admin')
                                        <img style="height: 150px" class="img-thumbnail" src="{{ asset('admin/profile_photo/'.$adminProfile->profile) }}" alt="">
                                    @elseif ($adminProfile->role != 'admin')
                                        <img style="height: 150px" class="img-thumbnail" src="{{ asset('user/profile_photo/'.$adminProfile->profile) }}" alt="">
                                    @endif
                                @endif
                            </div>

                        </div>
                        <div class="col-lg">
                            <div class="row">
                                <div class="col-lg-8 mb-3">

                                    <label class="form-label">Name</label>
                                    @if ($adminProfile->name != null)
                                        <input type="text" class="form-control" disabled value="{{ $adminProfile->name }}">
                                    @elseif ($adminProfile->name == null)
                                        <input type="text" class="form-control" disabled value="{{ $adminProfile->nickname }}">
                                    @endif

                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-lg-4 mb-3 ">
                                    <label  class="form-label">Email</label>
                                    <input type="email" name="" value="{{ $adminProfile->email }}" disabled>
                                </div>
                                <div class="col-lg-4 mb-3 mx-2">
                                    <label  class="form-label">Phone</label>
                                    <input type="text" name="" value="{{ $adminProfile->phone }}" disabled>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-lg-4 mb-3 ">
                                    <label  class="form-label">Address</label>
                                    <input type="text" name="" value="{{ $adminProfile->address }}" disabled>
                            </div>

                            <div class="row ">
                                <div class="col-lg-4 mb-3 ">
                                    <label  class="form-label">Role</label>
                                    <input type="text" name="" value="{{ $adminProfile->role }}" disabled>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
