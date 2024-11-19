@extends('user.layouts.master')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop Detail</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop Detail</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    {{-- <div class="row">
        <a href=""><button class="btn btn-success">Back</button></a>
    </div> --}}


    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 offset-2 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ asset('/uploads/' . $product->image) }}" class="img-fluid rounded"
                                        alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                            <p class="mb-3">Category: {{ $product->category_name }}</p>
                            <h5 class="fw-bold mb-3">{{ $product->price }} MMK</h5>
                            <div class="d-flex mb-4">
                                <p class="me-2">Average Rating : {{ $ratingCount }} </p>
                                @php $stars = number_format($ratingCount) @endphp
                                @for ($i=1; $i<=$stars; $i++)
                                    <i class="fa fa-star text-secondary"></i>
                                @endfor

                                @for ($j=$stars+1; $j<=5; $j++)
                                    <i class="fa fa-star"></i>
                                @endfor


                            </div>
                            <p class="mb-4">{{ $product->description }}</p>

                            <form action="{{ route('addToCart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="productId" value="{{ $product->id }}">
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="qty" class="form-control form-control-sm text-center border-0"
                                        value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                                    class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a></button>
                            </form>


                            {{-- Rating --}}
                            <!-- Button trigger modal -->
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Rating</button>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('addRating') }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Rate This Product</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card card-body mb-2">
                                                    <div class="rating-css">
                                                        <div class="star-icon">
                                                            <input type="hidden" name="productID" value="{{ $product->id}}">
                                                            <input type="hidden" name="userID" value="{{ auth()->user()->id }}">
                                                            @if ( $userRating != null )
                                                                @php
                                                                    $userRating = number_format($userRating)
                                                                @endphp

                                                                @for ($i = 1; $i <= $userRating; $i++)
                                                                    <input type="radio" value="{{ $i }}" name="course_rating" checked id="rating{{$i}}">
                                                                    <label for="rating{{$i}}" class="fa fa-star"></label>
                                                                @endfor

                                                                @for ($j = $userRating+1; $j <= 5; $j++)
                                                                    <input type="radio" value="{{ $j }}" name="course_rating" id="rating{{$j}}">
                                                                    <label for="rating{{$j}}" class="fa fa-star"></label>
                                                                @endfor
                                                            @else
                                                                <input type="radio" value="1" name="course_rating" checked id="rating1">
                                                                <label for="rating1" class="fa fa-star"></label>

                                                                <input type="radio" value="2" name="course_rating" id="rating2">
                                                                <label for="rating2" class="fa fa-star"></label>

                                                                <input type="radio" value="3" name="course_rating" id="rating3">
                                                                <label for="rating3" class="fa fa-star"></label>

                                                                <input type="radio" value="4" name="course_rating" id="rating4">
                                                                <label for="rating4" class="fa fa-star"></label>

                                                                <input type="radio" value="5" name="course_rating" id="rating5">
                                                                <label for="rating5" class="fa fa-star"></label>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- Rating end --}}
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <p>{{ $product->description }}</p>

                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                    @foreach ($comment as $item)
                                        <div class="d-flex">
                                            @if ($item->image == null)
                                                <img src="{{ asset('/user/img/avatar.jpg') }}"
                                                    class="img-fluid rounded-circle p-3"
                                                    style="width: 100px; height: 100px;" alt="">
                                            @else
                                                <img src="" class="img-fluid rounded-circle p-3"
                                                    style="width: 100px; height: 100px;" alt="">
                                            @endif

                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">
                                                    {{ $item->created_at->format('j-F-Y') }}</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>
                                                        @if ($item->name != null)
                                                            {{ $item->name }}
                                                        @else
                                                            {{ $item->nickname }}
                                                        @endif
                                                    </h5>
                                                    <div class="d-flex mb-3">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p>{{ $item->message }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <form action="{{ route('comment') }}" method="POST">
                            @csrf
                            <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                            <div class="row g-4">
                                <input type="hidden" name="userID" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="productID" value="{{ $product->id }}">
                                <div class="border-bottom rounded">
                                    <input type="text" class="form-control border-0 me-4"
                                        value="{{ auth()->user()->name }}" disabled>
                                </div>
                                <div class="border-bottom rounded">
                                    <input type="email" class="form-control border-0"
                                        value="{{ auth()->user()->email }}" disabled>
                                </div>
                                <div class="border-bottom rounded my-4">
                                    <textarea name="comment" id=""
                                        class="form-control border-0 @error('comment')
                                                is-invalid
                                            @enderror"
                                        cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                                </div>
                                @error('comment')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div>
                                    <input type="submit"
                                        class="btn border border-secondary text-primary rounded-pill px-4 py-3"
                                        value="Post Comment">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <h1 class="fw-bold mb-0">Related products</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    @foreach ($relatedProducts as $item)
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img style="height: 200px" src="{{ asset('uploads/'.$item->image)}}" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">{{$item->category_name}}</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>{{$item->name}}</h4>
                            <p>{{ Str::words($item->description, 10, '...')  }}</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold">{{$item->price}} MMK</p>
                                <a href="#"
                                    class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection
