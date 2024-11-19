@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">
            <!-- DataTales Example -->
            @if (auth()->user()->role == 'superadmin')
                <div class="card shadow mb-4 col-5">
                    <div class="card-header py-3">
                        <div class="">
                            <div class="">
                                <h6 class="m-0 font-weight-bold text-primary">Add Payment Page</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('paymentCreate') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Banking Name</label>
                                <select name="type" id="" class="form-control @error('type') is-invalid @enderror">
                                    <option value="">Choose Bank Account...</option>
                                    <option value="1" @if (old('type') == 1) selected @endif>KBZ Banking</option>
                                    <option value="2" @if (old('type') == 2) selected @endif>KBZ Pay</option>
                                    <option value="3" @if (old('type') == 3) selected @endif>AYA Banking</option>
                                    <option value="4" @if (old('type') == 4) selected @endif>AYA Pay</option>
                                </select>
                                @error('type')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Banking Name</label>
                                <input type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" placeholder="type Name">
                                @error('type')
                                    <small class=" invalid-feedback">{{$message}}</small>
                                @enderror
                            </div> --}}
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Account Number</label>
                                <input type="number" class="form-control @error('accountNumber') is-invalid @enderror" name="accountNumber" value="{{ old('accountNumber') }}" placeholder="Account Number">
                                @error('accountNumber')
                                    <small class=" invalid-feedback">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Account Name</label>
                                <input type="text" class="form-control @error('accountName') is-invalid @enderror" name="accountName" value="{{ old('accountName') }}" placeholder="Account Name">
                                @error('accountName')
                                    <small class=" invalid-feedback">{{$message}}</small>
                                @enderror
                            </div>

                            <input type="submit" value="Create" class="btn btn-primary">
                        </form>

                    </div>
                </div>
            @endif


            {{-- Payment List --}}
            <div class="card shadow mb-4 col-5 offset-1">
                <div class="card-header py-3">
                    <div class="">
                        <div class="">
                            <h6 class="m-0 font-weight-bold text-primary">Payment List</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($payment_account as $item)
                        <div class="mb-3">
                            <div class="row">
                                <p>Payment Type : </p>
                                <h4>{{ $item->account_name }}</h4>
                            </div>
                            <div class="row">
                                <p>Account Number : </p>
                                <h4>{{ $item->account_number }}</h4>
                            </div>
                            <hr>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
