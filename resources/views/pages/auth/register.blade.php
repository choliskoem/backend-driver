@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ url('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label for="frist_name">Name</label>
                        <input id="frist_name" type="text"
                            class="form-control @error('name')
                        is-invalid
                        @enderror"
                            name="name" autofocus>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="nomor">No HP</label>
                        <input id="nomor" type="text"
                            class="form-control @error('nomor')
                        is-invalid
                        @enderror"
                            name="nomor" autofocus>
                        @error('nomor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                {{-- <div class="form-group">
                    <label for="form-label">Roles</label>
                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="radio" name="roles" value="admin" class="selectgroup-input" checked="">
                            <span class="selectgroup-button">Admin</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="roles" value="driver" class="selectgroup-input">
                            <span class="selectgroup-button">Driver</span>
                        </label>

                    </div>
                </div> --}}


                <div class="form-group  ">
                    <label for="">
                        KTP / SIM / KTA
                    </label>
                    <div class="col-md-12">
                        <input type="file" class="form-control" name="image"
                            @error('image')
                            is-invalid
                        @enderror>
                    </div>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group  ">
                    <label for="">
                      Foto Wajah
                    </label>
                    <div class="col-md-12">
                        <input type="file" class="form-control" name="foto"
                            @error('foto')
                            is-invalid
                        @enderror>
                    </div>
                    @error('foto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="password" class="d-block">Password</label>
                    <input id="password" type="password"
                        class="form-control pwstrength @error('password')
                    is-invalid
                    @enderror"
                        data-indicator="pwindicator" name="password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="password2" class="d-block">Password Confirmation</label>
                    <input id="password2" type="password"
                        class="form-control @error('password_confirmation')
                    is-invalid
                    @enderror"
                        name="password_confirmation">
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-grad btn-lg btn-block">
                        Register
                    </button>
                </div>
                <div class="mt-5 text-center">
                    Have an account? <a href="{{ route('login') }}">Login Here</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush




{{-- @extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush


@section('main')

    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ url('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label for="frist_name">Name</label>
                        <input id="frist_name" type="text"
                            class="form-control @error('name')
                        is-invalid
                        @enderror"
                            name="name" autofocus>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="nomor">No HP</label>
                        <input id="nomor" type="text"
                            class="form-control @error('nomor')
                        is-invalid
                        @enderror"
                            name="nomor" autofocus>
                        @error('nomor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="form-label">Roles</label>
                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="radio" name="roles" value="admin" class="selectgroup-input" checked="">
                            <span class="selectgroup-button">Admin</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="roles" value="driver" class="selectgroup-input">
                            <span class="selectgroup-button">Driver</span>
                        </label>

                    </div>
                </div>


                <div class="form-group  ">
                    <label for="">
                        KTP / SIM / KTA
                    </label>
                    <div class="col-md-12">
                        <input type="file" class="form-control" name="image"
                            @error('image')
                            is-invalid
                        @enderror>
                    </div>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group ">
                    <label for="email">Email</label>
                    <input id="email" type="email"
                        class="form-control @error('email')
                    is-invalid
                    @enderror"
                        name="email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="password" class="d-block">Password</label>
                        <input id="password" type="password"
                            class="form-control pwstrength @error('password')
                        is-invalid
                        @enderror"
                            data-indicator="pwindicator" name="password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div id="pwindicator" class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="password2" class="d-block">Password Confirmation</label>
                        <input id="password2" type="password"
                            class="form-control @error('password_confirmation')
                        is-invalid
                        @enderror"
                            name="password_confirmation">
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-grad btn-lg btn-block">
                        Register
                    </button>
                </div>
                <div class="mt-5 text-center">
                    Have an account? <a href="{{ route('login') }}">Login Here</a>
                </div>
            </form>
        </div>
    </div>


@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush --}}
