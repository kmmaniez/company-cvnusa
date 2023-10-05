@extends('layouts.admin.master')
@push('assets')
    <style>

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

        <!-- Form -->
        <div class="col-xl-6 col-lg-6">

            @if (Session::has('success'))
                <div class="card border-left-success shadow w-100 mb-3" id="messageSuccess">
                    <div class="card-body">
                        <span>{{ Session::get('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data {{ $title }}</h6>
                </div>
                <div class="card-body">

                    <form 
                        action="{{ (count($data) > 0) ? route('informasi.update', $data[0]['id']) : route('informasi.store')  }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @if (count($data) > 0)
                            @method('PUT')
                        @endif

                        <div class="form-group mb-3">
                            <label for="logo">Logo Company</label>
                            @if (count($data) > 0 && isset($data[0]->logo))
                            <img class="d-block" id="logo-image" width="150" height="100" src="{{ Storage::url($data[0]->logo) }}" alt="logo" srcset="">
                            
                            @else
                            <img class="d-block" id="logo-image" width="150" height="100" src="{{ asset('assets/images/projects/project1.jpg') }}" alt="logo" srcset="">
                                
                            @endif
                            <input class="form-control mt-2" type="file" name="logo" id="logo">
                            @error('logo') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label"><strong>Email</strong></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" 
                            value="{{ isset($data[0]['email']) ? old('email', $data[0]['email']) : '' }}" placeholder="company@gmail.com" required> 
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="telepon" class="form-label"><strong>Telepon</strong></label>
                            <div class="input-group">
                                <span style="border-start-end-radius: 0; border-end-end-radius: 0" class="input-group-text text-secondary" id="basic-addon1">+62</span>
                                <input type="number" placeholder="821xxx" pattern="^0-9"  class="form-control @error('telepon') is-invalid @enderror" name="telepon" min="8" id="telepon" 
                                value="{{ isset($data[0]['telepon']) ? old('telepon', $data[0]['telepon']) : '' }}" required>
                            </div>
                            @error('telepon') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat" class="form-label"><strong>Alamat</strong></label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror"  name="alamat" id="alamat" cols="10" rows="2" placeholder="Jl. Soekarno Hatta...." required>{{ isset($data[0]['alamat']) ? old('alamat', $data[0]['alamat']) : '' }}</textarea>
                            @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="tentang" class="form-label"><strong>Tentang Kami</strong></label>
                            {{-- <textarea class="form-control @error('tentang') is-invalid @enderror"  name="tentang" id="tentang" cols="10" rows="2" placeholder="Kami adalah perusahaan ......" required>{{ isset($data[0]['tentang_kami']) ? old('tentang', $data[0]['tentang_kami']) : '' }}</textarea> --}}
                            {{-- @error('tentang') <small class="text-danger">{{ $message }}</small> @enderror --}}
                            <input id="tentang" type="hidden" name="tentang" value="{{ $data[0]['tentang_kami'] ?? '' }}">
                            <trix-editor id="tentang" input="tentang"></trix-editor>
                        </div>

                        <hr>

                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="facebook" class="form-label"><strong>Facebook</strong></label>
                                    <input type="url" class="form-control" name="facebook" id="facebook" 
                                    value="{{ isset($data[0]['facebook']) ? old('facebook', $data[0]['facebook']) : '' }}" placeholder="https://facebook.com/linkanda"> 
                                    
                                </div>
                                <div class="col-6">
                                    <label for="twitter" class="form-label"><strong>Twitter</strong></label>
                                    <input type="url" class="form-control" name="twitter" id="twitter" 
                                    value="{{ isset($data[0]['twitter']) ? old('twitter', $data[0]['twitter']) : '' }}" placeholder="https://twitter.com/linkanda"> 
                                    
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <label for="instagram" class="form-label"><strong>Instagram</strong></label>
                                    <input type="url" class="form-control" name="instagram" id="instagram" 
                                    value="{{ isset($data[0]['instagram']) ? old('instagram', $data[0]['instagram']) : '' }}" placeholder="https://instagram.com/linkanda"> 
                                    
                                </div>
                                <div class="col-6">
                                    <label for="linkedin" class="form-label"><strong>LinkedIn</strong></label>
                                    <input type="url" class="form-control" name="linkedin" id="linkedin" 
                                    value="{{ isset($data[0]['linkedin']) ? old('linkedin', $data[0]['linkedin']) : '' }}" placeholder="https://linkedin.com/linkanda"> 
                                    
                                </div>
                            </div>
                        </div>

                        @if (count($data) > 0)
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
                        <img src="{{ asset('sb-admin/reference/Informasi.png') }}" class="w-100" alt="" srcset="">
                        <figcaption>*Settings akan seperti digambar</figcaption>
                    </figure>
                </div>
            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            setTimeout(() => {
                $('#messageSuccess').css({
                    display: 'none'
                })
            }, 2000);
        })
        /* EVENT DISPLAY GAMBAR */
        $('#logo').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#logo-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            // $('.custom-upload').css('display','none')
        });
    </script>
@endpush
