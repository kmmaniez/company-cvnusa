@extends('layouts.admin.master')
@push('assets')
    <link href="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('konten')
    <x-admin.page-heading>{{ $title }}</x-admin.page-heading>
    {{-- @dump($data) --}}
    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data {{ $title }}</h6>
                </div>
                <div class="card-body">
                    <a href="" id="btnTambahJabatan" class="btn btn-md btn-primary mb-3" data-toggle="modal"
                        data-target="#modalService"><i class="fas fa-fw fa-plus"></i> Tambah {{ $title }}</a>
                        <a href="http://" id="tested">test</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Service</th>
                                    <th>Icon Service</th>
                                    <th>Gambar Service</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $service)
                                <tr>
                                    <td>{{ $service->title }}</td>
                                    <td>{{ $service->icon }}</td>
                                    <td><img src="{{ $service->logo ? url("photos/services/image/$service->logo") : url("assets/images/services/service1.jpg") }}" style="object-fit: cover;" width="auto" height="100" alt="gambar-service"></td>
                                    <td style="max-width: 300px;">{{ $service->description }}</td>
                                    <td>
                                        <a href="" class="btn btn-md btn-info" data-toggle="modal" data-target="#modalService" data-serv="{{ $service->id }}" id="btnServEdit"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                        <a href="" class="btn btn-md btn-danger" data-serv="{{ $service->id }}"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
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
                    <form action="" id="formClient" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_service" class="form-label">Nama Service</label>
                            <input type="text" class="form-control" name="nama_service" id="nama_service"
                                placeholder="cth: Desain Arsitektur">
                        </div>
                        <div class="mb-3">
                            <label for="icon_service" class="form-label">Icon Service <small class="text-primary"><strong>opsional</strong></small></label>
                            <img id="preview-icon" alt="" srcset="">
                            <input type="file" class="form-control" name="icon_service"
                                id="icon_service">
                                <span class="text-danger" id="icon-input-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="gambar_service" class="form-label">Gambar Service</label>
                            <img id="preview-image" alt="" srcset="">
                            <input type="file" class="form-control" name="gambar_service"
                                id="gambar_service">
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
        $(document).ready(function() {

            $('#modalService').on('hidden.bs.modal', function (e) {
                $('#nama_service').val('')
                $('#description').val('')
            })
        });

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
        $('#icon_service').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-icon').attr('src', e.target.result);
                $('#preview-icon').css({
                    display: 'block',
                    width: '64px',
                    height: '64px',
                    marginBottom: '8px',
                })
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#formClient').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: '{{ route('clients.store') }}',
                headers :{
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        this.reset();
                        console.log(response);
                        $('#modalService').modal('hide');
                        // alert('Image has been uploaded successfully');
                    }
                },
                error: function(response) {
                    // console.log(response.responseJSON.errors.nama_client[0]);
                    $('#image-input-error').text(response.responseJSON.message);
                }
            });
        });
        
        /* EDIT EVENT */
        $('body').on('click', '#btnServEdit', function(e) {
            e.preventDefault()
            $('#modalService').modal('show');
            let id = $(this).data('serv');

            $.get(window.location.pathname + '/' + id,
                function({data}, success) {
                    // console.log(data);
                    $('#nama_service').val(data.title)
                    $('#description').val(data.description)
                }
            )
        })

        $('#btnService').click(function(e) {
            e.preventDefault()
            const id = $(this).data('kat')

            $.ajax({
                url: window.location.pathname + '/' + id,
                method: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    nama_kategori: $('#nama_kategori').val()
                },
                success: function(res) {
                    console.log(res);
                    // $('#nama_kategori').val('');
                    // window.location.reload()
                },
                error: function(err) {
                    console.log(err);
                }
            })
        })

        // SWEETALER
        $(function(){

            $('#tested').on('click', function(e){
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
