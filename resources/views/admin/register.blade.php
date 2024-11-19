<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">

                    <div class="col-lg-6 offset-3">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <label for="">Name</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                    @error('name')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <label for="">Email</label>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user  @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                    @error('email')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control form-control-user  @error('password') is-invalid @enderror">
                                        @error('password')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control form-control-user  @error('password_confirmation') is-invalid @enderror">
                                        @error('password_confirmation')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" name="phone" class="form-control form-control-user @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                    @error('phone')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" class="form-control form-control-user @error('address') is-invalid @enderror" value="{{ old('address') }}">
                                    @error('address')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Register Account">
                                </div>
                                {{-- <a href="login.html" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </a> --}}
                                <hr>
                                {{-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> --}}
                            </form>
                            <hr>
                            {{-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div> --}}
                            <div class="text-center">
                                <a class="small" href="{{ route('userLogin') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js')}}"></script>

</body>

</html>
