@extends('layouts.admin.master')
@push('assets')
<link href="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- summernote -->
<link href="{{ asset('plugins/summernote/summernote.min.css') }}" rel="stylesheet">
<script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>

    <style>
        trix-editor {
            min-height: 180px;
        }

        /* trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        } */
        input#penulis{
            user-select: none;
            -moz-user-select: none;
        }
    </style>
@endpush
@section('konten')
    <x-admin.page-heading>{{ $title ?? 'eak'}}</x-admin.page-heading>

    <!-- Content Row -->

    <div class="row">

        <!-- Form -->
        <div class="col-xl-9 col-lg-6">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data {{ $title }}</h6>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 col">
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label d-block"><strong>Thumbail Post</strong></label>
                                    <img src="{{ asset('assets/images/projects/project1.jpg') }}" style="width: 100%" height="200" alt="thumbnail" srcset="">
                                    <input type="file" class="form-control mt-2" name="thumbnail" id="thumbnail">
                                </div>
                            </div>
                            <div class="col-lg-9 col">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label for="judul" class="form-label"><strong>Judul Post</strong></label>
                                            <input type="text" class="form-control" name="judul" id="judul" placeholder="cth: Tutorial Desain AutoCAD" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label for="slug" class="form-label"><strong>Slug</strong></label>
                                            <input type="text" class="form-control" name="slug" id="slug" readonly disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label"><strong>Kategori</strong></label>
                                    <input type="text" class="form-control" name="kategori" id="kategori" required>
                                </div>
                                <div class="mb-3">
                                    <label for="konten" class="form-label"><strong>Konten</strong></label>
                                    <input id="konten" type="hidden" name="konten">
                                    <trix-editor input="konten"></trix-editor>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label for="penulis" class="form-label"><strong>Penulis</strong></label>
                                            <input type="text" class="form-control" name="penulis" id="penulis" value="{{ auth()->user()->name }}" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label for="penulis" class="form-label"><strong>Tanggal</strong></label>
                                            <input type="text" class="form-control" name="penulis" id="penulis" value="{{ date('d-m-Y') }}" readonly disabled>
                                        </div>    
                                    </div>
                                </div>
                                <button class="btn btn-primary"><i class="fas fa-fw fa-save"></i>Simpan Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit culpa praesentium consequuntur veniam fugit possimus delectus facere, exercitationem amet. Ipsa illum laborum tempora, natus molestias ab doloribus aspernatur maiores minima repudiandae, explicabo corrupti, dicta incidunt! Voluptate, aperiam aliquid hic sit, porro accusantium minima itaque expedita atque exercitationem vero ea adipisci!</p> --}}

        <!-- Referensi -->
        <div class="col-xl-3 col-lg-6">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Daftar Kategori</h6>
                </div>
                <div class="card-body">
                    <a href="#" id="btnTambahKategori" data-toggle="modal" data-target="#modalKategori" class="btn btn-md btn-primary mb-2"><i class="fas fa-fw fa-plus"></i> Tambah Kategori</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $data)
                                    <tr>
                                        <td>{{ $data->nama_kategori }}</td>
                                        <td class="d-flex flex-column" style="gap: 4px;">
                                            <a href="#" id="btnEditKategori" class="btn btn-sm btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            {{-- <a href="#" data-kat="{{ $data->id }}" id="btnHapusKategori" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-edit"></i> Hapus</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- @dump($kategori) --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Modal Kategori -->
    <div class="modal fade" id="modalKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $title_kat }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formKategoriBlog">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" placeholder="cth: Desain Arsitektur">
                        </div>
                        <button class="btn btn-md btn-primary" id="btnSimpanKategori" type="submit"><i class="fas fa-fw fa-save"></i> Simpan</button>
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

        /* FUNGSI TAMBAH KATEGORI */
        $('body').on('click', '#btnTambahKategori', function(e) {
            $('#modalKategori').modal('show');

            $('#btnSimpanKategori').on('click',function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                $.ajax({
                    url: '{{ route('katpost.store') }}',
                    method: 'POST',
                    data:{
                        _token: '{{ csrf_token() }}',
                        nama_kategori: $('#nama_kategori').val()
                    },
                    success:function(res){
                        console.log(res);
                        $('#modalKategori').modal('hide');
                        $('#nama_kategori').val('')
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: res.message,
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    }
                })
                // console.log('ea');
            })
        })

        // /* FUNGSI HAPUS KATEGORI */
        // $('body').on('click', '#btnHapusKategori', function(e) {
        //     e.preventDefault()
        //     let url = window.location.pathname;
        //     let replaceUrl = url.replace('posts/create','kategori')
        //     Swal.fire({
        //         title: 'Anda yakin?',
        //         text: "Apakah anda ingin menghapus data ini ?",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Ya, hapus data!',
        //         cancelButtonText: 'Tidak',
        //         })
        //         .then((result) => {
        //             if (result.isConfirmed) {
        //             $.ajax({
        //                 // url: window.location.pathname+'/destroy/'+$(this).data('user'),
        //                 url: replaceUrl+'/destroy/'+$(this).data('kat'),
        //                 method: 'GET',
        //                 cache: false,
        //                 data:{
        //                     _token: '{{ csrf_token() }}',
        //                     id: $(this).data('kat')
        //                 },
        //                 success:function(res){ 
        //                     console.log(res);
        //                     Swal.fire({
        //                         type: 'success',
        //                         icon: 'success',
        //                         title: res.message,
        //                         showConfirmButton: false,
        //                         timer: 2000,
        //                     });
        //                     // displaySweetAlert('success','success', response.message, 2500)
        //                     // $('#DTUsers').DataTable().ajax.reload();
        //                 }
        //             });
        //             }
        //     })
        // })
$('#editor').summernote({
			  	height: 500
			  });
    </script>
@endpush
