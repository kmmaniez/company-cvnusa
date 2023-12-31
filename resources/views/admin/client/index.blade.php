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
                    <a href="" id="btnTambahClient" class="btn btn-md btn-primary mb-3"><i
                            class="fas fa-fw fa-plus"></i> Tambah Client</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="DTClients" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Client</th>
                                    <th>Logo Client</th>
                                    <th>Telepon/Whatsapp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $client)
                                    <tr>
                                        <td>{{ $client->nama }}</td>
                                        <td>
                                            <img src="{{ Storage::url($client->logo) }}" style="object-fit: cover;" width="300" height="150" alt="client-logo">
                                        </td>
                                        <td>{{ $client->telepon }}</td>
                                        <td>
                                            <a href="#" data-client="{{ $client->id }}" id="btnEditClient" class="btn btn-md btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="#" data-client="{{ $client->id }}" id="btnHapusClient" class="btn btn-md btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
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
    <div class="modal fade" id="modalClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <form id="formClient">
                        <div class="mb-3">
                            <label for="nama_client" class="form-label">Nama Client</label>
                            <input type="text" class="form-control" name="nama_client" id="nama_client"
                                placeholder="cth: Pertamina">
                            <span class="text-danger" id="nama-input-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo Client</label>
                            <img id="preview-logo" loading="lazy" alt="" srcset="">
                            <input type="file" class="form-control" name="logo" id="logo">
                            <span class="text-danger" id="image-input-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="telepon_client" class="form-label">Telepon/Whatsapp client</label>
                            <input type="number" class="form-control" name="telepon_client" id="telepon_client"
                                placeholder="08xx-xxxx-xxx">
                        </div>
                        <button class="btn btn-md btn-primary" id="btnSimpanClient"><i
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
    <script src="{{ url('sb-admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('sb-admin') }}/js/demo/datatables-demo.js"></script>
    <script>
        let idClient;
        /* EVENT MODAL HIDDEN */
        $('#modalClient').on('hidden.bs.modal', function(e) {
            $('#nama_client').val('')
            $('#telepon_client').val('')
            $('#nama-input-error').text('')
            $('#image-input-error').text('')
            $('#preview-logo').css('display', 'none');
        })

        /* EVENT DISPLAY GAMBAR */
        $('#logo').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-logo').attr('src', e.target.result);
                $('#preview-logo').css({
                    display: 'block',
                    width: '300px',
                    height: '150px',
                    marginBottom: '8px',
                })
            }
            reader.readAsDataURL(this.files[0]);
        });

        /* EVENT TAMBAH CLIENT */
        $('body').on('click', '#btnTambahClient', function(e) {
            e.preventDefault()
            $('#modalClient').modal('show');

            $('#formClient').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                let formData = new FormData(this);
                $('#image-input-error').text('');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('clients.store') }}',
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
                            $('#nama_client').val('')
                            $('#telepon_client').val('')
                            $('#modalClient').modal('hide');
                            $('#nama-input-error').text('')
                            setTimeout(() => {
                                window.location.reload();
                            }, 2500);
                        }
                    },
                    error: function(res) {
                        const {
                            errors
                        } = res.responseJSON;
                        if (errors.nama_client) {
                            $('#nama-input-error').text(errors.nama_client[0]);
                        }
                        if (errors.logo) {
                            $('#image-input-error').text(errors.logo[0]);
                        }
                    }
                });
            });

        });

        /* EVENT GET DATA BY ID */
        $('body').on('click', '#btnEditClient', function(e) {
            e.preventDefault()

            $('#modalClient').modal('show');
            $.ajax({
                url: window.location.pathname + '/' + $(this).data('client'),
                method: 'GET',
                success: (res) => {
                    const {
                        data
                    } = res
                    idClient = data.id
                    let url = data.logo
                    let replaceUrl = url.replace('public/clients', 'storage/clients')

                    $('#nama_client').val(data.nama);
                    $('#telepon_client').val(data.telepon);
                    $('#preview-logo').attr('src', `${window.location.origin}/${replaceUrl}`)
                    $('#preview-logo').css({
                        display: 'block',
                        width: '300px',
                        height: '150px',
                        marginBottom: '8px',
                    })
                },
            })

            $('#formClient').submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                let formData = new FormData(this);
                formData.append('_method', 'PATCH')
                $('#image-input-error').text('');

                $.ajax({
                    url: window.location.pathname + '/' + idClient,
                    type: 'POST',
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
                            $('#nama_client').val('')
                            $('#telepon_client').val('')
                            $('#modalClient').modal('hide');
                            $('#nama-input-error').text('')
                            setTimeout(() => {
                                window.location.reload();
                            }, 2500);
                        }
                    },
                    error: function(response) {
                        const {
                            errors
                        } = response.responseJSON;
                        if (errors.nama_client) {
                            $('#nama-input-error').text(errors.nama_client[0]);
                        }
                        if (errors.nama_client) {
                            $('#image-input-error').text(errors.logo[0]);
                        }
                    }
                });
            });
        })

        /* HAPUS CLIENT */
        $('body').on('click', '#btnHapusClient', function(e) {
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
                            url: window.location.pathname + '/' + $(this).data('client'),
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: $(this).data('client')
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
                                }, 2500);
                            },error: (err) => {
                                console.log(err);
                            }
                        })
                    }
                })
        })

        /* INISIALISASI DATATABLE */
        $('#DTClients').DataTable({
            orderable: false,
            searchable: false
        })
    </script>
@endpush
