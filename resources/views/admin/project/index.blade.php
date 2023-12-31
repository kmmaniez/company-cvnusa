@extends('layouts.admin.master')
@push('assets')
    <link href="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('konten')
    <x-admin.page-heading>{{ $title }}</x-admin.page-heading>

    <!-- Content Row -->
    {{-- @dump($projects) --}}
    <div class="row">

        <div class="col-xl-7 col-lg-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data Projects</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('projects.create') }}" class="btn btn-md btn-primary mb-3"><i
                            class="fas fa-fw fa-plus"></i> Tambah Projects</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar Thumbnail</th>
                                    <th>Nama Projects</th>
                                    <th>Keterangan Projects</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ Storage::url($project->thumbnail) }}"
                                                class="w-100" height="96" alt="gambar project">
                                        </td>
                                        <td>{{ $project->nama_project }}</td>
                                        <td>{{ Str::limit($project->keterangan_project, 30, '...') }}</td>

                                        <td class="d-flex flex-column" style="gap: 4px;">
                                            <a href="{{ route('public.project-single', $project->slug) }}"
                                                target="_blank" class="btn btn-md btn-outline-secondary"><i
                                                    class="fas fa-fw fa-eye"></i> Lihat</a>
                                                    
                                            <a href="{{ route('projects.edit', $project->slug) }}"
                                                class="btn btn-md btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>

                                            <a href="#" id="btnHapusProject" data-project="{{ $project->slug }}"
                                                class="btn btn-md btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
                                            {{-- <form action="{{ route('projects.destroy', $project->slug) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-md btn-danger w-100"><i
                                                        class="fas fa-fw fa-trash-alt"></i> Delete</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-5 col-lg-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data {{ $title }}</h6>
                </div>
                <div class="card-body">
                    <a href="" class="btn btn-md btn-primary mb-3" id="btnKatCreate" data-toggle="modal"
                        data-target="#modalKategori"><i class="fas fa-fw fa-plus"></i> Tambah Kategori</a>
                    <div class="table-responsive">
                        <table class="table" id="DTKategori" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategoris</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategori as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_kategori }}</td>
                                        <td>
                                            <a href="#" id="btnKatEdit" data-kat="{{ $data->id }}"
                                                data-toggle="modal" data-target="#modal-update"
                                                class="btn btn-sm btn-info"><i class="fas fa-fw fa-edit"></i>
                                                Edit</a>
                                            <a href="#" id="btnKatDelete" data-kat="{{ $data->id }}"
                                                class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash-alt"></i>
                                                Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="3">Data kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- CRUD Modal Projects -->
    <div class="modal fade" id="modalProject" tabindex="-1" role="dialog" aria-labelledby="modalProject"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProject">Tambah Project</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formProject">
                        <div class="mb-3">
                            <label for="nama_project" class="form-label">Nama Project</label>
                            <input type="text" class="form-control" name="nama_project" id="nama_project"
                                placeholder="cth: Desain Stadion">
                        </div>
                        <div class="mb-3">
                            <label for="nama_client" class="form-label">Nama Client</label>
                            <input type="text" class="form-control" name="nama_client" id="nama_client"
                                placeholder="cth: Pertamina">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan_project" class="form-label">Keterangan Project</label>
                            <textarea class="form-control" name="keterangan_project" id="keterangan_project" cols="30" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kategori_project" class="form-label">Category / select2</label>
                            <input type="text" class="form-control" name="kategori_project" id="kategori_project">
                        </div>
                        <div class="mb-3">
                            <label for="lokasi_project" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi_project" id="lokasi_project">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai">
                                    <span class="text-primary">*opsional</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="tanggal_selesai"
                                        id="tanggal_selesai">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar_project" class="form-label">Gambar Project (bisa lebih dari 1)</label>
                            <input class="form-control" type="file" name="gambar_project" id="gambar_project"
                                multiple>
                        </div>
                        <button class="btn btn-md btn-primary" id="btnSimpanProject"><i class="fas fa-fw fa-save"></i>
                            Simpan</button>
                        <button class="btn btn-md btn-secondary" type="reset"><i class="fas fa-fw fa-undo"></i>
                            Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL KATEGORI -->
    <div class="modal fade" id="modalKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCategory">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" name="nama_kategori" id="nama_kategori"
                                placeholder="cth: Interior">
                            <span class="text-danger" id="name-error"></span>
                        </div>
                        <button class="btn btn-md btn-primary" id="btnKategori"><i
                                class="fas fa-fw fa-save"></i>Simpan</button>
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
            // $('#DTKategori').DataTable()

            $('#modalKategori').on('hidden.bs.modal', function(e) {
                $('#nama_kategori').val('')
            })
        });

        /* EVENT TAMBAH CLIENT */
        $('body').on('click', '#btnTambahProject', function(e) {
            e.preventDefault()
            $('#modalProject').modal('show');

            $('#formProject').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                const imgArr = formData.getAll('gambar_project')
                formData.append('gambar', imgArr)
                // console.log(imgArr);
                console.log(formData);
                // console.log(formData.getAll('gambar_project'));
                $.ajax({
                    type: 'POST',
                    url: '{{ route('projects.store') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (res) => {
                        if (res) {
                            // this.reset();
                            console.log(res);
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

        });

         /* HAPUS CLIENT */
         $('body').on('click', '#btnHapusProject', function(e) {
            e.preventDefault();
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
                            url: window.location.pathname + '/' + $(this).data('project'),
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE',
                                slug: $(this).data('project')
                            },
                            success: (res) => {
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
                                // $('#DTClients').DataTable().ajax.reload();
                            }
                        })
                    }
                })
        })

        /* FUNGSI UNTUK CREATE KATEGORI */
        $('body').on('click', '#btnKatCreate', function() {

            $('#modalKategori').modal('show');

            $('#btnKategori').click(function(e) {
                e.preventDefault()
                e.stopImmediatePropagation();
                $.ajax({
                    url: '{{ route('kategoriproject.store') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        nama_kategori: $('#nama_kategori').val(),
                    },
                    success: (res) => {
                        $('#modalKategori').modal('hide');
                        $('#nama_kategori').val('');
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        setTimeout(() => {
                            window.location.reload()
                        }, 2000);
                    },
                    error: function(res) {
                        const {
                            errors
                        } = res.responseJSON;
                        if (errors.nama_kategori) {
                            $('#name').addClass('is-invalid');
                            $('#name-error').text(errors.nama_kategori[0]);
                        }
                    }
                })
            })
        })

        /* FUNGSI UNTUK EDIT KATEGORI*/
        $('body').on('click', '#btnKatEdit', function() {
            $('#modalKategori').modal('show');
            let id = $(this).data('kat');
            const url = '{{ route('kategoriproject.index') }}'
            $.get(url + '/' + id,
                function({
                    data
                }, success) {
                    // console.log(data);
                    $('#nama_kategori').val(data.nama_kategori)
                    $('#btnKategori').data('kat', data.id);
                }
            )
        })

        /* FUNGSI UNTUK UPDATE KATEGORI */
        $('#btnKategori').click(function(e) {
            e.preventDefault()
            const id = $(this).data('kat')
            const url = window.location.pathname;
            const urlReplace = url.replace('projects', 'kategoriproject');

            $.ajax({
                url: urlReplace + '/' + id,
                method: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    nama_kategori: $('#nama_kategori').val()
                },
                success: function(res) {
                    $('#modalKategori').modal('hide');
                    $('#nama_kategori').val('');
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: res.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    setTimeout(() => {
                        window.location.reload()
                    }, 2000);
                },
                error: function(err) {
                    console.log(err);
                }
            })
        })

        /* FUNGSI UNTUK DELETE KATEGORI*/
        $('body').on('click', '#btnKatDelete', function(e) {
            e.preventDefault()
            const id = $(this).data('kat')
            const url = window.location.pathname;
            const urlReplace = url.replace('projects', 'kategoriproject');

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
                            url: urlReplace + '/' + id,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id,
                            },
                            success: function(res) {
                                Swal.fire({
                                    type: 'success',
                                    icon: 'success',
                                    title: res.message,
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                                setTimeout(() => {
                                    window.location.reload()
                                }, 2000);
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    }
                })
        })
    </script>
@endpush
