@extends('layouts.admin.master')
@push('assets')
    <link href="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('konten')
    <x-admin.page-heading>{{ $title }}</x-admin.page-heading>

    <!-- Content Row -->

    <div class="row">

        <div class="col-xl-12 col-lg-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data {{ $title }}</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('posts.create') }}" id="btnTambahTeam" class="btn btn-md btn-primary mb-3"><i
                            class="fas fa-fw fa-plus"></i> Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="DTPosts" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Judul</th>
                                    <th>Slug</th>
                                    <th>Thumbnail</th>
                                    <th>Penulis</th>
                                    <th>Kategori</th>
                                    <th style="width: 184px;">Keterangan</th>
                                    <th style="width: 184px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>


    </div>
@endsection
@push('scripts')
    <script src="{{ url('sb-admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('sb-admin') }}/js/demo/datatables-demo.js"></script>

    <script>
        /* INISIALISASI DATATABLE */
        $('#DTPosts').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('posts.getallposts') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'slug',
                    name: 'slug',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'thumbnail',
                    name: 'thumbnail',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'user_id',
                    name: 'user'
                },
                {
                    data: 'kategoripost_id',
                    name: 'kategori'
                },
                {
                    data: 'updated_at',
                    name: 'published_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            lengthMenu: [5,10,25,50,100],
            "language": {
                "processing": "<div class=\"spinner-border bg-transparent\" role=\"status\"></div>"
            }
        });
    </script>
@endpush
