@extends('layouts.admin.master')

@section('konten')
    <x-admin.page-heading>{{ $title }}</x-admin.page-heading>

    <!-- Content Row -->

    <div class="row">


        <div class="col-xl-12 col-lg-6">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data {{ $title }}</h6>
                </div>
                <div class="card-body">
                    <p>Lihat contoh carousel <a href="http://">disini</a> | Carousel maks 5 gambar & min 3 gambar untuk hasil
                        terbaik.</p>
                    <a href="" id="btnTambahCarousel" class="btn btn-md btn-primary mb-3"><i
                            class="fas fa-fw fa-plus"></i> Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Slide Title</th>
                                    <th>Slide Sub-Title</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carousels as $carousel)
                                    <tr>
                                        <td>
                                            @if (isset($carousel->image))
                                                <img src="{{ Storage::url($carousel->image) }}" width="300"
                                                    height="150" alt="gambar-subtitle">
                                            @else
                                                <p>-</p>
                                            @endif
                                        </td>
                                        <td>{{ $carousel->slide_title }}</td>
                                        <td>{{ $carousel->slide_subtitle }}</td>
                                        <td>{{ $carousel->description }}</td>
                                        <td>
                                            <a href="#" data-carousel="{{ $carousel->id }}" id="btnEditCarousel"
                                                class="btn btn-md btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="#" data-carousel="{{ $carousel->id }}" id="btnHapusCarousel"
                                                class="btn btn-md btn-danger"><i class="fas fa-fw fa-trash-alt"></i>
                                                Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Modal Carousel -->
    <div class="modal fade" id="modalCarousel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data {{ $title }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCarousel">
                        <div class="mb-3">
                            <label for="gambar_carousel" class="form-label">Gambar Carousel</label>
                            <img id="preview-image" alt="" srcset="">
                            <input type="file" class="form-control" name="gambar_carousel" id="gambar_carousel">
                            <span class="text-danger" id="image-input-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="slide_title" class="form-label">Slide Title</label>
                            <input type="text" class="form-control" name="slide_title" id="slide_title"
                                placeholder="cth: Desain Arsitektur">
                            <span class="text-danger" id="title-input-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="slide_subtitle" class="form-label">Slide Sub-Title</label>
                            <input type="text" class="form-control" name="slide_subtitle" id="slide_subtitle"
                                placeholder="cth: Desain Arsitektur">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                        </div>
                        <button class="btn btn-md btn-primary" id="btnService"><i
                                class="fas fa-fw fa-save"></i>Simpan</button>
                        <button class="btn btn-md btn-secondary" type="reset"><i
                                class="fas fa-fw fa-undo"></i>Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        /* FUNGSI TAMBAH CAROUSEL */
        $('body').on('click', '#btnTambahCarousel', function(e) {
            e.preventDefault()
            $('#modalCarousel').modal('show');

            $('#formCarousel').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                let formData = new FormData(this);
                $('#image-input-error').text('');
                // console.log(formData);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('carousels.store') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (res) => {
                        if (res) {
                            this.reset();
                            console.log(res);
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: res.message,
                                showConfirmButton: false,
                                timer: 2000,
                            });
                            $('#modalCarousel').modal('hide');
                            setTimeout(() => {
                                window.location.reload()
                            }, 2500);
                        }
                    },
                    error: function(response) {
                        const {
                            errors
                        } = response.responseJSON;
                        console.log(errors);
                        if (errors.slide_title) {
                            $('#title-input-error').text(errors.slide_title[0]);
                        }
                        if (errors.gambar_carousel) {
                            $('#image-input-error').text(errors.gambar_carousel[0]);
                        }
                        // if (errors.nama_client) {
                        //     $('#image-input-error').text(errors.gambar_carousel[0]);
                        // }
                    }
                });
            });

        });

        /* FUNGSI EDIT CAROUSEL */
        $(document).ready(function() {

            $('body').on('click', '#btnEditCarousel', function(e) {
                e.preventDefault()

                $('#modalCarousel').modal('show');
                id = $(this).data('carousel');

                /* FUNGSI UNTUK GET CAROUSEL BY ID */
                $.ajax({
                    url: window.location.pathname + '/' + id,
                    method: 'GET',
                    success: (res) => {
                        const {
                            data
                        } = res
                        $('#slide_title').val(data.slide_title);
                        $('#slide_subtitle').val(data.slide_subtitle);
                        $('#description').val(data.description);
                    },
                    error: function(res) {
                        const {
                            errors
                        } = res.responseJSON;

                    }
                })

                /* FUNGSI UNTUK UPDATE CAROUSEL */
                $('#formCarousel').submit(function(e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    let formData = new FormData(this);
                    $('#image-input-error').text('');

                    formData.append('_method','PATCH')
                    $.ajax({
                        type: 'POST',
                        url: window.location.pathname+'/'+id,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: (res) => {
                            if (res) {
                                this.reset();
                                Swal.fire({
                                    type: 'success',
                                    icon: 'success',
                                    title: res.message,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                                $('#modalCarousel').modal('hide');
                                setTimeout(() => {
                                    window.location.reload()
                                }, 2500);
                            }
                        },
                        error: function(response) {
                            const {
                                errors
                            } = response.responseJSON;
                            console.log(errors);
                            if (errors.slide_title) {
                                $('#title-input-error').text(errors.slide_title[0]);
                            }
                            if (errors.gambar_carousel) {
                                $('#image-input-error').text(errors.gambar_carousel[0]);
                            }
                        }
                    });
                });
            })

        })

        /* FUNGSI HAPUS CAROUSEL */
        $('body').on('click', '#btnHapusCarousel', function(e) {
            const id = $(this).data('carousel')
            console.log(id);
            e.preventDefault()
            Swal.fire({
                    title: 'Anda yakin?',
                    text: "Apakah anda ingin menghapus data ini ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus data!',
                    cancelButtonText: 'Tidak',
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: window.location.pathname + '/' + id,
                            method: 'DELETE',
                            cache: false,
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id
                            },
                            success: function(res) {
                                Swal.fire({
                                    type: 'success',
                                    icon: 'success',
                                    title: res.message,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                                $('#modalCarousel').modal('hide');
                                setTimeout(() => {
                                    window.location.reload()
                                }, 2500);
                            }
                        });
                    }
                })
        })
    </script>
@endpush
