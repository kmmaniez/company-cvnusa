@extends('layouts.admin.master')
@push('assets')
    <link href="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                    {{-- @dump($blog) --}}
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
                                            <input type="text" class="form-control" name="judul" id="judul" placeholder="cth: Tutorial Desain AutoCAD" value="{{ old('judul', $blog->title) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label for="slug" class="form-label"><strong>Slug</strong></label>
                                            <input type="text" class="form-control" name="slug" id="slug" value="{{ $blog->slug }}" disabled readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label"><strong>Kategori</strong></label>
                                    <input type="text" class="form-control" name="kategori" id="kategori" value="{{ $blog->kategoris->nama_kategori }}">
                                </div>
                                <div class="mb-3">
                                    <label for="konten" class="form-label"><strong>Konten</strong></label>
                                    <input id="konten" type="hidden" name="konten">
                                    <trix-editor input="konten">{{ $blog->content }}</trix-editor>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-12">
                                        <div class="mb-3">
                                            <label for="penulis" class="form-label"><strong>Penulis</strong></label>
                                            <input type="text" class="form-control" name="penulis" id="penulis" value="{{ $blog->users->name }}" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="mb-3">
                                            <label for="penulis" class="form-label"><strong>Editor</strong></label>
                                            <input type="text" class="form-control" name="penulis" id="penulis" value="{{ auth()->user()->name }}" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-12">
                                        <div class="mb-3">
                                            <label for="penulis" class="form-label"><strong>Tanggal Dibuat</strong></label>
                                            <input type="text" class="form-control" name="penulis" id="penulis" value="{{ date('d-m-Y') }}" readonly disabled>
                                        </div>    
                                    </div>
                                    <div class="col-lg-2 col-12">
                                        <div class="mb-3">
                                            <label for="penulis" class="form-label"><strong>Tanggal Diubah</strong></label>
                                            <input type="text" class="form-control" name="penulis" id="penulis" value="{{ date('d-m-Y') }}" readonly disabled>
                                        </div>    
                                    </div>
                                </div>
                                <button class="btn btn-primary"><i class="fas fa-fw fa-save"></i>Simpan Data</button>
                                <a href="{{ route('blogs.index') }}" class="btn btn-secondary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
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
                    <a href="#" id="btnTambahKategori" class="btn btn-md btn-primary mb-2"><i class="fas fa-fw fa-plus"></i> Tambah Kategori</a>
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
                                            <a href="#" id="btnEditUser" class="btn btn-sm btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="#" id="btnEditUser" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-edit"></i> Hapus</a>
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
@endsection
@push('scripts')
<script src="{{ url('sb-admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('sb-admin') }}/js/demo/datatables-demo.js"></script>
    <script>
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endpush
