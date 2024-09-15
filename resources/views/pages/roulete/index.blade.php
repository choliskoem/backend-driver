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

    <!-- Custom CSS for Roulette -->
    <style>
        .roulette-container {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .spin-button {
            margin-top: 30px;
            padding: 15px 30px;
            font-size: 24px;
            background-color: #8EC13E;
            border: none;
            color: white;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .spin-button:hover {
            background-color: #76A534;
            transform: scale(1.1);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        }

        .nomor-undian-list {
            margin-top: 40px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .nomor-undian-item {
            font-size: 20px;
            margin: 10px;
            padding: 15px 25px;
            background-color: #e2e6ea;
            border-radius: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .nomor-undian-item:hover {
            transform: scale(1.1);
            background-color: #d6dadb;
        }

        .section-header {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }

        .section-header h1 {
            font-size: 36px;
            color: #343a40;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Roulette Undian</h1>
            </div>

            <div class="section-body">
                <div class="roulette-container">
                    <h2>Roulette - Pilih Pemenang</h2>

                    <!-- Menampilkan pesan sukses atau error -->
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- Form untuk memutar roulette -->
                    <form action="/roulette/spin" method="POST">
                        @csrf
                        <button type="submit" class="spin-button">Putar Roulette</button>
                    </form>

                    <!-- Menampilkan daftar nomor undian yang belum keluar -->
                    <div class="nomor-undian-list">
                        <h2>Daftar Nomor Undian</h2>
                        @forelse($nomorUndians as $nomorUndian)
                            <div class="nomor-undian-item">
                                {{ $nomorUndian->nomor_undian }}
                            </div>
                        @empty
                            <p class="text-muted">Tidak ada nomor undian yang tersedia.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
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
    <script src="/js/page/modules-toastr.js"></script>
    <script src="/js/page/forms-advanced-forms.js"></script>
    <script src="/js/page/bootstrap-modal.js"></script>

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
@endpush
