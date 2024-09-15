@extends('layouts.app')

@section('title', 'Users')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/library/selectric/public/selectric.css">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Users</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Users</a></div>
                    <div class="breadcrumb-item">All Users</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>

                </div>
                <h2 class="section-title">Users</h2>
                <p class="section-lead">
                    You can manage all Users, such as editing, deleting and more.
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Posts</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div>
                                <div class="float-right">
                                    <form method="GET" action="{{ route('user.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Name</th>
                                            <th>Nomor HP</th>
                                            <th>Level</th>
                                            <th>Status</th>
                                            <th>Foto FB</th>
                                            <th>Foto IG</th>
                                            <th>Created At</th>
                                            <th>Hapus</th>
                                            <th>Ubah Status</th>
                                        </tr>

                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->id_level }}</td>
                                                <td>{{ $user->status }}</td>
                                                <td>
                                                    <img src="/storage/foto_fb/{{ $user->foto_fb }}" alt="Facebook Photo"
                                                        width="50" class="mb-5 mt-2"
                                                        style="object-fit: cover; cursor: pointer;"
                                                        onclick="window.open('/storage/foto_fb/{{ $user->foto_fb }}', '_blank')">
                                                </td>
                                                <td>
                                                    <img src="/storage/foto_ig/{{ $user->foto_ig }}" alt="Instagram Photo"
                                                        width="50" class="mb-5 mt-2"
                                                        style="object-fit: cover; cursor: pointer;"
                                                        onclick="window.open('/storage/foto_ig/{{ $user->foto_ig }}', '_blank')">

                                                </td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>

                                                    <div class="d-flex justify-content-center">
                                                        {{-- <a href="{{ route('user.edit', $user->id) }}"
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a> --}}
                                                        <form action="{{ route('user.destroy', $user->id_akun) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form id="user-form3" action="/user/{{ $user->id_akun }}"
                                                        method="POST" class="ml-2">

                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Tidak perlu field input di sini -->
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $users->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="/library/selectric/public/jquery.selectric.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="/js/page/features-posts.js"></script>
@endpush
