@extends('layouts.admin.master')
@push('assets')
    <link href="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        input.form-control.is-invalid:focus {
            /* background-color: red; */
            box-shadow: none;
            border: 1px solid #ff887d;
        }

        trix-editor {
            min-height: 100px;
        }

        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
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
                    <a href="" class="btn btn-md btn-primary mb-3" id="btnTambahHarga" data-toggle="modal"
                        data-target="#modal-create"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="DTPrice" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th>Custom Text Button</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($prices as $price)
                                    <tr>
                                        <td>{{ $price->judul }}</td>
                                        <td>Rp. {{ number_format($price->harga, 0, 2, ',') }}</td>
                                        <td>{!! $price->keterangan !!}</td>
                                        <td>{{ $price->custom_text_button }}</td>
                                        <td>
                                            <a href="#" data-id="{{ $price->id }}" id="btnEditModal"
                                                class="btn btn-warning">Edit</a>
                                            <a href="#" data-id="{{ $price->id }}" id="btnHapusModal"
                                                class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="5"><i>Tidak ada data</i></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Create Modal Price -->
    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah List Harga</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCreatePrice">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga" id="harga" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label" id="labelket">Keterangan</label>
                            <input id="keterangan" type="hidden" name="keterangan">
                            <trix-editor input="keterangan"></trix-editor>
                        </div>
                        <div class="mb-3">
                            <label for="custom_text_button" class="form-label">Custom Text Button (lihat hasil)</label>
                            <input type="text" class="form-control" name="custom_text_button" id="custom_text_button"
                                placeholder="">
                        </div>
                        <div class="mb-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" value="on" name="highlight_harga"
                                    id="highlight_harga">
                                <label class="custom-control-label" for="highlight_harga">Highlight Harga ?</label>
                            </div>
                        </div>
                        <button class="btn btn-md btn-primary" id="btnSimpanHarga"><i
                                class="fas fa-fw fa-save"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal Category -->
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah List Harga</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditPrice">
                        <div class="mb-3">
                            <label for="judul_edit" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul_edit" id="judul_edit">
                        </div>
                        <div class="mb-3">
                            <label for="harga_edit" class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga_edit" id="harga_edit">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan_edit" class="form-label" id="labelket">Keterangan</label>
                            <input id="keterangan_edit" type="hidden" name="keterangan_edit">
                            <trix-editor id="trx_ket_edit" input="keterangan_edit"></trix-editor>
                        </div>
                        <div class="mb-3">
                            <label for="custom_text_button_edit" class="form-label">Custom Text Button (lihat
                                hasil)</label>
                            <input type="text" class="form-control" name="custom_text_button_edit"
                                id="custom_text_button_edit">
                        </div>
                        <div class="mb-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" value="on"
                                    name="highlight_harga_edit" id="highlight_harga_edit">
                                <label class="custom-control-label" for="highlight_harga_edit">Highlight Harga ?</label>
                            </div>
                        </div>
                        <button class="btn btn-md btn-primary" id="btnUpdateHarga"><i
                                class="fas fa-fw fa-save"></i>Update</button>
                    </form>
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
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });

        $(document).ready(function() {
            let ids;

            /* FUNGSI TAMBAH HARGA */
            $('body').on('click', '#btnSimpanHarga', function(e) {
                e.preventDefault()
                $.ajax({
                    url: '{{ route('prices.store') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        judul: $('#judul').val(),
                        harga: $('#harga').val(),
                        keterangan: $('#keterangan').val(),
                        custom_text_button: $('#custom_text_button').val(),
                        is_featured: $('#highlight_harga').prop('checked') ?? false,
                    },
                    success: function(data) {
                        $('#judul').val('')
                        $('#harga').val('')
                        $('#keterangan').val('')
                        $('#custom_text_button').val('')
                        $('#modal-create').modal('hide')
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            })

            /* FUNGSI GET HARGA BY ID */
            $('body').on('click', '#btnEditModal', function(e) {
                e.preventDefault()
                $('#modal-edit').modal('show')

                ids = $(this).data('id')
                $.ajax({
                    url: `${window.location.pathname}/${ids}`,
                    method: 'GET',
                    success: function(data) {
                        $('#judul_edit').val(data.data.judul)
                        $('#harga_edit').val(data.data.harga)
                        $('#trx_ket_edit').val(data.data.keterangan)
                        $('#highlight_harga_edit')[0].checked = data.data.is_featured
                        $('#custom_text_button_edit').val(data.data.custom_text_button)
                    },
                })

            })

            /* FUNGSI UPDATE HARGA */
            $('body').on('click', '#btnUpdateHarga', function(e) {
                e.preventDefault()

                $.ajax({
                    url: `${window.location.pathname}/${ids}`,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        judul: $('#judul_edit').val(),
                        harga: $('#harga_edit').val(),
                        keterangan: $('#keterangan_edit').val(),
                        custom_text_button: $('#custom_text_button_edit').val(),
                        is_featured: $('#highlight_harga_edit').prop('checked') ?? false,
                    },
                    success: function(res) {
                        console.log(res);
                        $('#judul_edit').val('')
                        $('#harga_edit').val('')
                        $('#trx_ket_edit').val('')
                        $('#custom_text_button_edit').val('')
                        $('#modal-edit').modal('hide')
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            })

            /* FUNGSI HAPUS DATA */
            $('body').on('click', '#btnHapusModal', function(e) {
                e.preventDefault()
                ids = $(this).data('id')

                $.ajax({
                    url: `${window.location.pathname}/${ids}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ids
                    },
                    success: function(res) {
                        console.log(res);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            })
        })
    </script>
@endpush
