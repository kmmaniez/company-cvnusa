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
                    <a href="" id="btnTambahService" class="btn btn-md btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah {{ $title }}</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="DTService" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Service</th>
                                    <th>Gambar Service</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $service)
                                    <tr>
                                        <td>{{ $service->title }}</td>
                                        <td>
                                            @if (isset($service->gambar))
                                            <img src="{{ Storage::url($service->gambar) }}" style="object-fit: cover;" width="auto" height="100" alt="gambar-service">
                                            @else
                                            <img src="{{ url('assets/images/services/service1.jpg') }}" style="object-fit: cover;" width="auto" height="100" alt="gambar-service">
                                            @endif
                                        </td>
                                        <td style="max-width: 300px;">{{ $service->description }}</td>
                                        <td>
                                            <a href="" class="btn btn-md btn-info" data-toggle="modal"
                                                data-target="#modalService" data-serv="{{ $service->id }}"
                                                id="btnEditService"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="" id="btnHapusService" class="btn btn-md btn-danger"
                                                data-serv="{{ $service->id }}"><i class="fas fa-fw fa-trash-alt"></i>
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

    <!-- Modal Client -->
    <div class="modal fade" id="modalService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <form id="formService">
                        <div class="mb-3">
                            <label for="nama_service" class="form-label">Nama Service</label>
                            <input type="text" class="form-control" name="nama_service" id="nama_service"
                                placeholder="cth: Desain Arsitektur">
                        </div>
                        <div class="mb-3">
                            <label for="gambar_service" class="form-label">Gambar Service</label>
                            <img id="preview-image" alt="" srcset="">
                            <input type="file" class="form-control" name="gambar_service" id="gambar_service">
                            <span class="text-danger" id="image-input-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                        </div>
                        <button class="btn btn-md btn-primary" id="btnService"><i class="fas fa-fw fa-save"></i>
                            Simpan</button>
                        <button class="btn btn-md btn-secondary" type="reset"><i class="fas fa-fw fa-undo"></i>
                            Reset</button>
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
        let id;
        $(document).ready(function() {

            $('#modalService').on('hidden.bs.modal', function(e) {
                $('#nama_service').val('')
                $('#description').val('')
                // $('#preview-image').attr('src', '{{ url('assets/images/services/service1.jpg') }}')
            })
        });

        /* FUNGSI PREVIEW IMAGE */
        $('#gambar_service').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image').attr('src', e.target.result);
                $('#preview-image').css({
                    display: 'block',
                    width: '300px',
                    height: '150px',
                    marginBottom: '8px',
                })
            }
            reader.readAsDataURL(this.files[0]);
        });

        /* FUNGSI TAMBAH SERVICE */
        $('body').on('click','#btnTambahService', function(e) {
            e.preventDefault()
            $('#modalService').modal('show');

            $('#formService').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('#image-input-error').text('');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('services.store') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                            $('#modalService').modal('hide');
                            setTimeout(() => {
                                window.location.reload();
                            }, 2500);

                        }
                    },
                    error: function(res) {
                        // // console.log(response.responseJSON.errors.nama_client[0]);
                        // $('#image-input-error').text(response.responseJSON.message);
                    }
                });
            });
        })

        /* FUNGSI EDIT SERVICE */
        $(document).ready(function() {

            $('body').on('click', '#btnEditService', function(e) {
                e.preventDefault()

                $('#modalService').modal('show');
                id = $(this).data('serv');

                /* FUNGSI UNTUK GET SERVICE BY ID */
                $.ajax({
                    url: window.location.pathname + '/' + id,
                    method: 'GET',
                    success: (res) => {
                        const {
                            data
                        } = res
                        $('#nama_service').val(data.title)
                        $('#description').val(data.description)
                    },
                    error: function(res) {
                        const {
                            errors
                        } = res.responseJSON;

                    }
                })

                /* FUNGSI UNTUK UPDATE SERVICE */
                $('#formService').submit(function(e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    let formData = new FormData(this);
                    $('#image-input-error').text('');

                    formData.append('_method', 'PATCH')
                    $.ajax({
                        type: 'POST',
                        url: window.location.pathname + '/' + id,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: (res) => {
                            if (res) {
                                this.reset();
                                $('#modalService').modal('hide');
                                Swal.fire({
                                    type: 'success',
                                    icon: 'success',
                                    title: res.message,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                                setTimeout(() => {
                                    window.location.reload()
                                }, 2500);
                            }
                        },
                        error: function(res) {
                            // const {
                            //     errors
                            // } = response.responseJSON;
                            console.log(res);
                            // if (errors.slide_title) {
                            //     $('#title-input-error').text(errors.slide_title[0]);
                            // }
                            // if (errors.gambar_carousel) {
                            //     $('#image-input-error').text(errors.gambar_carousel[0]);
                            // }
                        }
                    });
                });
            })

        })

        /* FUNGSI HAPUS SERVICE */
        $('body').on('click', '#btnHapusService', function(e) {
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
                            url: window.location.pathname + '/' + $(this).data('serv'),
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: $(this).data('serv')
                            },
                            success: (res) => {
                                console.log(res);
                                Swal.fire({
                                    type: 'success',
                                    icon: 'success',
                                    title: res.message,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1000);
                            }
                        })
                    }
                })
        })

        /* INISIALISASI DATATABLE */
        $('#DTService').DataTable({
            paging: false,
            searching: false,
        })
        // SWEETALER
        $(function() {

            $('#tested').on('click', function(e) {
                e.preventDefault()
                Swal.fire({
                    title: 'Error!',
                    text: 'Do you want to continue',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false,
                    confirmButtonText: 'Cool'
                })
            })
        })
    </script>
@endpush
