@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <form action="{{ route('productUpdate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 p-3">
                            <div class="mx-2">
                                <label class="form-label">Image</label>
                                <input type="hidden" value="{{ $product->id }}" name="id">
                                <input type="hidden" value="{{ $product->image }}" name="oldImage">
                                <img class="img-thumbnail" id="output" src="{{ asset('/uploads/'.$product->image) }}" alt="">
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
                                        name="name" value="{{ old('name',$product->name) }}" placeholder="Product Name">
                                    @error('name')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 mb-3">
                                    <label class="form-label">Category</label>
                                    <select name="category" class="form-control  @error('category') is-invalid @enderror">
                                        <option value="">Choose Category...</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" @if (old('category',$product->category_id) == $item->id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-lg-4 mb-3 ">
                                    <label  class="form-label">Price</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price',$product->price) }}" placeholder="Product price">
                                    @error('price')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3 mx-2">
                                    <label  class="form-label">Units</label>
                                    <input type="text" class="form-control @error('count') is-invalid @enderror" name="count" value="{{ old('count',$product->count) }}" placeholder="Product Count">
                                    @error('count')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-lg-8">
                                    <label class="form-label">Product Description</label>
                                    <div>
                                        <textarea class=" form-control @error('description') is-invalid @enderror" name="description" cols="30" rows="10">{{ old('description',$product->description) }}</textarea>
                                        @error('description')
                                            <small class=" invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>


                                </div>

                            </div>
                            <div class="row p-2">
                                <div class="col-lg">
                                    <input type="submit" value="update" class="btn btn-primary p-2">
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
