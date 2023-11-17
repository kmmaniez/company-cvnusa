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
            <form action="{{ route('projects.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col">
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label d-block"><strong>Thumbnail Project</strong></label>
                            <img id="thumbnail-image" src="{{ asset('assets/images/projects/project1.jpg') }}"
                                style="width: 100%" height="200" alt="thumbnail" srcset="">
                            <input type="file" class="form-control mt-2" name="thumbnail" id="thumbnail">
                            @error('thumbnail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-9 col">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="nama_project" class="form-label">Nama Project</label>
                                    <input type="text" class="form-control @error('nama_project') is-invalid @enderror" name="nama_project" id="nama_project"
                                        placeholder="cth: Desain Stadion" value="{{ old('nama_project') }}">
                                    @error('nama_project')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>        
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="slug_project" class="form-label">Slug Project</label>
                                    <input type="text" class="form-control" name="slug_project" id="slug_project" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama_client" class="form-label">Nama Client</label>
                            <input type="text" class="form-control" name="nama_client" id="nama_client" value="{{ old('nama_client') }}" placeholder="cth: Pertamina">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan_project" class="form-label">Keterangan Project</label>
                            <textarea class="form-control" name="keterangan_project" id="keterangan_project" cols="30" rows="3">{{ old('keterangan_project') }}</textarea>
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
                                    <input type="date" class="form-control" value="{{ old('start_date') }}" name="start_date" id="start_date">
                                    <span class="text-primary">*opsional</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="finish_date" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control @error('nama_project') is-invalid @enderror" value="{{ old('finish_date') }}" name="finish_date" id="finish_date">
                                    @error('finish_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar_project" class="form-label">Gambar Project (minimal: 1 gambar)</label>
                            <input class="form-control" type="file" name="gambar_project[]" id="gambar_project" multiple>
                            @foreach ($errors->get('gambar_project.*') as $message)
                                <span class="text-danger">{{ $message[0] }}</span>
                            @endforeach
                            @error('gambar_project')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
        /* EVENT DISPLAY GAMBAR */
        $('#thumbnail').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#thumbnail-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
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