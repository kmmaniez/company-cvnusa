@extends('layouts.admin.master')
@push('assets')
    <link href="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/summernote/summernote-bs4.min.css') }}">
    <link href="{{ asset('assets/summernote/summernote.min.css') }}" rel="stylesheet">
@endpush
@section('konten')
    <x-admin.page-heading>{{ $title }}</x-admin.page-heading>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Data {{ $title }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.update', $data->slug) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-lg-3 col">
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label d-block"><strong>Thumbnail Project</strong></label>
                            <img id="thumbnail" src="{{ Storage::url(json_decode($data->gambar_project)[0]) }}"
                                style="width: 100%" height="300" class="object-fit-cover" alt="thumbnail" srcset="">
                            <input type="file" class="form-control mt-2" name="thumbnail" id="thumbnail">
                        </div>
                    </div>
                    <div class="col-lg-9 col">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="nama_project" class="form-label">Nama Project</label>
                                    <input type="text" class="form-control" name="nama_project" id="nama_project" value="{{ old('nama_project', $data->nama_project) }}">
                                </div>        
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="slug_project" class="form-label">Slug Project</label>
                                    <input type="text" class="form-control" name="slug_project" id="slug_project" value="{{ $data->slug }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan_project" class="form-label">Keterangan Project</label>
                            <textarea class="form-control" name="keterangan_project" id="keterangan_project" cols="30" rows="3">{{ $data->keterangan_project }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kategori_project" class="form-label">Category / select2</label>
                            <input type="text" class="form-control" name="kategori_project" id="kategori_project">
                        </div>
                        {{-- <div class="mb-3">
                            <label for="lokasi_project" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi_project" id="lokasi_project">
                        </div> --}}
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $data->start_date }}">
                                    <span class="text-primary">*opsional</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="finish_date" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="finish_date" id="finish_date" value="{{ $data->finish_date }}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar_project" class="form-label">Gambar Project (bisa lebih dari 1)</label>
                            <div class="group-images mb-2">
                                @foreach (json_decode($data->gambar_project) as $gambar)
                                    @if ($loop->index != 0)
                                    <img id="thumbnail" class="object-fit-cover" src="{{ Storage::url($gambar) }}" width="164" height="164" alt="thumbnail" srcset="">
                                    @endif
                                @endforeach
                            </div>
                            <input class="form-control" type="file" name="gambar_project[]" id="gambar_project" multiple>
                        </div>
                        <button class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // CHECK SLUG
        $('#nama_project').change(function(e) {
            $.get(`{{ route('projects.checkslug') }}`, {
                'title' : $(this).val()
            }, function(res){
                $('#slug_project').val(res.slug)
            })
        });
    </script>
@endpush