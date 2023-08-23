@extends('layouts.admin.master')
@push('assets')
    <style>
        trix-editor {
            min-height: 180px;
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

        <!-- Form -->
        <div class="col-xl-6 col-lg-6">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data {{ $title }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ ($jmlhdata > 0) ? route('about.update', $data[0]['id']) : route('about.store')  }}" method="post">
                        @csrf
                        @if ($jmlhdata > 0)
                            @method('PUT')
                        @endif
                        <input type="hidden" name="aboutid" value="{{ ($jmlhdata > 0) ? $data[0]['id'] : ''}}">
                        <div class="mb-3">
                            <label for="tagline_title" class="form-label"><strong>Tagline</strong></label>
                            <input type="text" class="form-control" name="tagline_title" id="tagline_title"
                                placeholder="contoh: Who We Are" value="{{ isset($data[0]['tagline_title']) ? old('title', $data[0]['tagline_title']) : '' }}" required>
                                
                        </div>
                        <div class="mb-3">
                            <label for="tagline_content" class="form-label"><strong>Tagline Content</strong></label>
                            <input id="tagline_content" type="hidden" name="tagline_content" value="{{ ($jmlhdata > 0) ? $data[0]['tagline_content'] : '' }}">
                            <trix-editor input="tagline_content"></trix-editor>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="title_vision" class="form-label"><strong>Title Vision</strong></label>
                            <input type="text" class="form-control" name="title_vision" id="title_vision"
                                placeholder="contoh: Our Vision" value="{{ isset($data[0]['title_vision']) ? old('title', $data[0]['title_vision']) : '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="content_vision" class="form-label"><strong>Vision Content</strong></label>
                            <input id="content_vision" type="hidden" name="content_vision" value="{{ ($jmlhdata > 0) ? $data[0]['content_vision'] : '' }}">
                            <trix-editor input="content_vision"></trix-editor>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="title_mision" class="form-label"><strong>Title Mission</strong></label>
                            <input type="text" class="form-control" name="title_mision" id="title_mision"
                                placeholder="contoh: Our Mission" value="{{ isset($data[0]['title_mision']) ? old('title', $data[0]['title_mision']) : '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="content_mision" class="form-label"><strong>Mision Content</strong></label>
                            <input id="content_mision" type="hidden" name="content_mision" value="{{ ($jmlhdata > 0) ? $data[0]['content_mision'] : '' }}">
                            <trix-editor input="content_mision"></trix-editor>
                        </div>
                        @if ($jmlhdata > 0)
                            <button class="btn btn-success"><i class="fas fa-fw fa-edit"></i>Ubah Data</button>
                        @else
                            <button class="btn btn-primary"><i class="fas fa-fw fa-save"></i>Simpan Data</button>
                        @endif
                    </form>
                </div>
            </div>

        </div>

        <!-- Referensi -->
        <div class="col-xl-6 col-lg-6">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Referensi Hasil</h6>
                </div>
                <div class="card-body">
                    <figure class="text-center">
                        <img src="{{ asset('sb-admin/reference/about.png') }}" class="w-100" alt="" srcset="">
                        <figcaption>*Settings akan berdampak ke <a href="{{ route('public.about') }}"
                                target="_blank">sini</a></figcaption>
                    </figure>
                </div>
            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endpush
