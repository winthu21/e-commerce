@extends('user.layouts.master')

@section('content')

    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <form action="{{ route('shopList') }}" method="get">
                                @csrf
                                <div class="input-group w-100 mx-auto d-flex">
                                        <input type="text" name="searchKey" class="form-control p-3" value="{{ request('searchKey') }}" placeholder="keywords" aria-describedby="search-icon-1">
                                        <button type="submit" class=" input-group-text p-3"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            <li>
                                                <div class="d-flex justify-content-between fruite-name">
                                                    <a href="{{ route('shopList') }}"><i class="fas fa-apple-alt me-2"></i>All</a>
                                                    <span>{{ $productsCount }}</span>
                                                </div>
                                            </li>
                                            @foreach ($category as $item)
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="{{ route('shopList',$item->id) }}"><i class="fas fa-apple-alt me-2"></i>{{$item->name}}</a>

                                                        {{-- <span>{{ $products->count() }}</span> --}}
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <form action="{{ route('shopList') }}" method="get">
                                        @csrf
                                        <div class="mb-3">
                                            <h4 class="mb-2">Price</h4>
                                            <input type="number" class="" name="minPrice" value="{{ request('minPrice') }}" placeholder="Minimum Price">
                                            <input type="number" class="" name="maxPrice" value="{{ request('maxPrice') }}" placeholder="Maximum Price">
                                            <input type="submit" class="btn btn-secondary" value="Filter">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center">
                                @foreach ($products as $item)
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img style="height: 250px" src="{{ asset('/uploads/'.$item->image) }}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{ $item->category_name }}</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{ $item->name }}</h4>
                                                <p>{{ $item->description }}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">{{ $item->price }} MMK</p>
                                                    <a href="{{ route('itemDetails',$item->id) }}">Details</a>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">{{ $products->links()}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->


@endsection
