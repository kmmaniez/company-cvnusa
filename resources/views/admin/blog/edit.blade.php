@extends('layouts.admin.master')
@push('assets')
    <link href="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/summernote/summernote-bs4.min.css') }}">
    <link href="{{ asset('assets/summernote/summernote.min.css') }}" rel="stylesheet">

@endpush
@section('konten')
    <x-admin.page-heading>{{ $title }}</x-admin.page-heading>

    <!-- Content Row -->

    <div class="row">

        <!-- Form -->
        <div class="col-xl-9 col-lg-6">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data {{ $title }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('posts.update', $blog->slug) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-lg-3 col">
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label d-block"><strong>Thumbail Post</strong></label>
                                    <img src="{{ asset('assets/images/projects/project1.jpg') }}" style="width: 100%"
                                        height="200" alt="thumbnail" srcset="">
                                    <input type="file" class="form-control mt-2" name="thumbnail" id="thumbnail">
                                </div>
                            </div>
                            <div class="col-lg-9 col">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label for="title" class="form-label"><strong>Judul Post</strong></label>
                                            <input type="text" class="form-control" name="title" id="title"
                                                placeholder="cth: Tutorial Desain AutoCAD"
                                                value="{{ old('judul', $blog->title) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label for="slug" class="form-label"><strong>Slug</strong></label>
                                            <input type="text" class="form-control" name="slug" id="slug"
                                                value="{{ $blog->slug }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="kategoripost_id" class="form-label"><strong>Kategori</strong></label>
                                    <select class="form-control" name="kategoripost_id" id="kategoripost_id">
                                    @foreach ($kategori as $data)
                                        <option value="{{ $data->id }}" {{ ($data->id === $blog->kategoripost_id) ? 'selected' : '' }}>{{ $data->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label"><strong>Konten</strong></label>
                                    <textarea id="editor" name="content">{{ $blog->content }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-12">
                                        <div class="mb-3">
                                            <label for="penulis" class="form-label"><strong>Penulis</strong></label>
                                            <input type="text" class="form-control" name="penulis" id="penulis"
                                                value="{{ $blog->users->name }}" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="mb-3">
                                            <label for="penulis" class="form-label"><strong>Editor</strong></label>
                                            <input type="text" class="form-control" name="penulis" id="penulis"
                                                value="{{ auth()->user()->name }}" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-12">
                                        <div class="mb-3">
                                            <label for="penulis" class="form-label"><strong>Tanggal Dibuat</strong></label>
                                            <input type="text" class="form-control" name="penulis" id="penulis"
                                                value="{{ date('d-m-Y') }}" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-12">
                                        <div class="mb-3">
                                            <label for="penulis" class="form-label"><strong>Tanggal Diubah</strong></label>
                                            <input type="text" class="form-control" name="penulis" id="penulis"
                                                value="{{ date('d-m-Y') }}" readonly disabled>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary"><i class="fas fa-fw fa-save"></i>Simpan Data</button>
                                <a href="{{ route('posts.index') }}" class="btn btn-secondary"><i
                                        class="fas fa-fw fa-arrow-left"></i>Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

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
                                            <a href="#" id="btnEditUser" class="btn btn-sm btn-info"><i
                                                    class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="#" id="btnEditUser" class="btn btn-sm btn-danger"><i
                                                    class="fas fa-fw fa-edit"></i> Hapus</a>
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
    <script src="{{ asset('assets/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('assets/summernote/summernote-bs4.min.js') }}"></script>

    <script>
        $('#editor').summernote({
            height: 300
        });
        // CHECK SLUG
        $('#title').change(function(e) {
            $.get(`{{ route('posts.checkslug') }}`, {
                'title' : $(this).val()
            }, function(res){
                $('#slug').val(res.slug)
            })
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
    </script>
@endpush
