@extends('layouts.app')

@section('title', 'Peminjaman')

@push('style')
    <!-- CSS Libraries -->

    <link rel="stylesheet" href="/library/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/library/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/library/selectric/public/selectric.css">
    <link rel="stylesheet" href="/library/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
@endpush

@section('main')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Point</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>No Telpon</th>
                                    <th>Point</th>
                                    {{-- <th>Kelurahan</th>
                                    <th>No SU</th>
                                    <th>Tipe Hak</th>
                                    <th>No Hak</th>
                                    <th>Jenis</th>
                                    <th>Pelayanan</th>
                                    <th>Rak</th>
                                    <th>Baris</th>
                                    <th>Kolom</th>
                                    <th>Bundle</th>
                                    <th>Keterangan</th>
                                    <th>Waktu</th>
                                    <th>Status</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->point }}</td>
                                        {{-- <td>{{ $buku->kelurahan }}</td>
                                        <td>{{ $buku->no_su }}</td>
                                        <td>{{ $buku->tipe_hak }}</td>
                                        <td>{{ $buku->no_hak }}</td>
                                        <td>{{ $buku->jenis }}</td>
                                        <td>{{ $buku->pelayanan }}</td>
                                        <td>{{ $buku->rak }}</td>
                                        <td>{{ $buku->baris }}</td>
                                        <td>{{ $buku->kolom }}</td>
                                        <td>{{ $buku->bundle }}</td>
                                        <td>{{ $buku->keterangan }}</td>
                                        <td>{{ $buku->waktu_dipinjam }}</td> --}}
                                        {{-- <td>

                                            @if ($buku->status == 'Peminjaman')
                                                <form action="{{ route('peminjaman.destroy', $buku->id_pinjam) }}" method="POST"
                                                    class="ml-2">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                        <i class="fas fa-times"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            @elseif ($buku->status == 'Arsip Dikirim')
                                                <button class="btn btn-icon btn-success">Disetujui</button>
                                            @elseif ($buku->status == 'Dikembalikan')
                                                <button class="btn btn-icon btn-success">Dikembalikan</button>
                                            @elseif ($buku->status == 'Selesai')
                                                <button class="btn btn-icon btn-success">Selesai</button>
                                            @endif


                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>


@endsection

@push('scripts')
    <!-- JS Libraies -->

    {{-- <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script> --}}
    <script src="/library/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/library/cleave.js/dist/cleave.min.js"></script>
    <script src="/library/cleave.js/dist/addons/cleave-phone.us.js"></script>
    <script src="/library/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="/library/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="/library/select2/dist/js/select2.full.min.js"></script>
    <script src="/library/selectric/public/jquery.selectric.min.js"></script>
    <script src="/library/izitoast/dist/js/iziToast.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="/js/page/modules-toastr.js') }}"></script>


    <!-- Page Specific JS File -->
    <script src="/js/page/forms-advanced-forms.js') }}"></script>
    <script src="/js/page/bootstrap-modal.js') }}"></script>


    <script>
        @if (Session::has('success'))
            iziToast.success({
                title: 'Success',
                message: '{{ Session::get('success') }}',
                position: 'topRight'
            });
        @endif

        @if (Session::has('error'))
            iziToast.error({
                title: 'Error',
                message: '{{ Session::get('error') }}',
                position: 'topRight'
            });
        @endif
    </script>





    <!-- Page Specific JS File -->
    {{-- <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script> --}}





    <!-- Page Specific JS File -->
@endpush
