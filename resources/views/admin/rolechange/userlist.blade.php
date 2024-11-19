@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                {{-- <div class="col-lg-8 input-group mb-3">
                    <form action="{{ route('productList') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-lg">
                                <input type="text" name="searchKey" class="form-control" value="{{ request('searchKey') }}" placeholder="Search Products...">
                            </div>

                            <div class="col-lg-2">
                                <button type="submit" class="form-control btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </form>
                </div> --}}

                <div class="d-flex justify-content-between">
                    <div class="">
                        <a href="{{ route('adminListPage') }}"><button class="btn btn-primary">Admin List ({{ $adminCount }})</button></a>
                        <a href="{{ route('userListPage')}}"><button class="btn btn-secondary">User List ({{ $userCount }})</button></a>
                    </div>
                    <div class="">
                        <a href="{{ route('adminCreatePage') }}"><i class="fa-solid fa-plus"></i> Add Admin</a>
                    </div>
                </div>


            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Provider</th>
                                <th>Role</th>
                                <th>Phone</th>
                                <th>Address</th>
                                @if (auth()->user()->role == 'superadmin')
                                    <th>Change Role</th>
                                @endif
                                @if (auth()->user()->role == 'superadmin')
                                    <th>Delete Account</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('eachProfilePage',$item->id) }}">
                                            @if ($item->name != null)
                                                {{ $item->name }}
                                            @else
                                            {{ $item->nickname }}
                                            @endif
                                        </a>
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->provider}}</td>
                                    <td class="text-primary">{{ $item->role}}</td>
                                    <td>{{ $item->phone}}</td>
                                    <td>{{ $item->address}}</td>
                                    @if (auth()->user()->role == 'superadmin')
                                        <td><a href="{{ route('changeToAdmin',$item->id) }}"><button class="btn btn-primary">Upgrade to Admin</button></a></td>
                                    @endif
                                    @if (auth()->user()->role == 'superadmin')
                                        <td class=" text-center"><a href="{{ route('deleteAccount',$item->id)}}"><button class="btn btn-danger">Delete</button></td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <span class="d-flex justify-content-end">{{ $data->links()}}</span>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
