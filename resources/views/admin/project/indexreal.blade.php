@extends('layouts.admin.master')

@section('konten')
    <x-admin.page-heading>{{ $title }}</x-admin.page-heading>

    <!-- Content Row -->

    <div class="row">


        <div class="col-xl-6 col-lg-6">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data {{ $title }}</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama_project" class="form-label">Nama Project</label>
                        <input type="text" class="form-control" name="nama_project" id="nama_project"
                            placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="nama_project" class="form-label">Keterangan Project</label>
                        <input type="text" class="form-control" name="nama_project" id="nama_project"
                            placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="nama_project" class="form-label">Category / select</label>
                        <input type="text" class="form-control" name="nama_project" id="nama_project"
                            placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="nama_project" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" name="nama_project" id="nama_project"
                            placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="nama_project" class="form-label">Ukuran</label>
                        <input type="text" class="form-control" name="nama_project" id="nama_project"
                            placeholder="1000 M2 X 1500 M2">
                    </div>
                    <div class="mb-3">
                        <label for="nama_project" class="form-label">Tanggal Project Selesai</label>
                        <input type="date" class="form-control" name="nama_project" id="nama_project"
                            placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Gambars</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
