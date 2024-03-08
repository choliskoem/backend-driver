<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex align-items-stretch flex-wrap">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="m-3 p-4">
                        <div class="d-flex justify-content-between"> <img src="{{ asset('img/logo-toko.png   ') }}"
                                alt="logo" width="100" class="  mb-5 mt-2">
                            <p>{{ $qrCode }}</p>
                        </div>

                        <h4 class="text-dark font-weight-normal">Welcome to <span class="font-weight-bold">Dapoer
                                Dindra</span>
                        </h4>
                        <p class="text-muted">Before you get started, you must login or register if you don't already
                            have an account.</p>
                        <form method="POST" action="{{ url('/proses_login') }}" class="needs-validation"
                            novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="no_hp">Nomor HP</label>
                                <input id="no_hp" type="no_hp"
                                    class="form-control @error('no_hp')
                                    is-invalid
                                    @enderror"
                                    name="no_hp" tabindex="1" autofocus>
                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password"
                                    class="form-control @error('password')
                                    is-invalid

                                    @enderror"
                                    name="password" tabindex="2">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-grad btn-lg btn-block" tabindex="4">
                                    Login
                                </button>
                            </div>
                            <div class="mt-5 text-center">
                                Don't have an account? <a href="{{ route('register') }}">Create One</a>
                            </div>
                        </form>

                        <div class="text-small mt-5 text-center">
                            Copyright &copy; DapoerDindra2024
                            <div class="mt-2">
                                {{-- <a href="#">Privacy Policy</a>
                                <div class="bullet"></div>
                                <a href="#">Terms of Service</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 min-vh-100 background-walk-y position-relative overlay-gradient-bottom order-1"
                    data-background="{{ asset('img/maps.png') }}">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                            <img src="http://34.142.197.204:8080/storage/verifikasi/1709886927.png">
                                <h1 class="display-4 font-weight-bold mb-2">Good Morning</h1>
                                <h5 class="font-weight-normal text-muted-transparent">Gorontalo, Indonesia</h5>
                            </div>
                            {{-- Photo by <a class="text-light bb" target="_blank"
                                href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a
                                class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a> --}}
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            function checkForChanges() {
                $.ajax({
                    url: '{{ route('latest.data') }}',
                    type: 'GET',
                    // Assuming formData contains the data to be added
                    success: function(response) {
                        // Handle successful response
                        if (response.reload = true) {
                            location.reload();
                        }


                        // console.log(response.message);
                        // location.reload(); // Reload the page
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });
            }

            // Check for changes every 5 seconds (adjust the interval as needed)
            setInterval(checkForChanges, 20000);
        });




        // function checkForUpdates() {
        //     $.ajax({
        //         url: "{{ route('latest.data') }}",
        //         type: 'GET',
        //         success: function(response) {
        //             // Compare response with existing data
        //             // If new data is detected, reload the page
        //             // You can customize this part based on your requirements
        //             if (response.qrcode_id > currentLatestDataId) {
        //                 location.reload();
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error(error);
        //         }
        //     });
        // }

        // // Call checkForUpdates every 5 seconds
        // setInterval(checkForUpdates, 5000);
    </script>


</body>

</html>



{{-- @extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="card card-gradient">
        <div class="card-header">
            <h4>Login</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email"
                        class="form-control @error('email')
                    is-invalid
                    @enderror"
                        name="email" tabindex="1" autofocus>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password"
                        class="form-control @error('password')
                    is-invalid

                    @enderror"
                        name="password" tabindex="2">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-grad btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="text-muted mt-5 text-center">
        Don't have an account? <a href="{{ route('register') }}">Create One</a>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush --}}
