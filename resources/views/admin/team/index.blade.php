@extends('layouts.admin.master')
@push('assets')
    <link href="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('konten')
    <x-admin.page-heading>{{ $title }}</x-admin.page-heading>

    <!-- Content Row -->

    <div class="row">

        <div class="col-xl-8 col-lg-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data {{ $title }}</h6>
                </div>
                <div class="card-body">
                    <a href="" id="btnTambahTeam" class="btn btn-md btn-primary mb-3" ><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
                    <a href="" id="btnTambahJabatan" class="btn btn-md btn-secondary mb-3" data-toggle="modal" data-target="#tambahJabatanModal">Tambah Jabatan</a>
                    <p>Lihat contoh teams <a href="http://">disini</a></p>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="DTAnggota" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Foto</th>
                                    <th>Sosial Media</th>
                                    <th>Age</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teams as $team)
                                <tr>
                                    <td>{{ $team->nama_anggota }}</td>
                                    <td>{{ $team->jabatans->nama_jabatan }}</td>
                                    <td>
                                        <img src="{{ (isset($team->foto_anggota)) ? Storage::url($team->foto_anggota) : asset('sb-admin/reference/user_profile.jpg') }}" style="object-fit: cover;" width="200" height="150" alt="client-logo">
                                    </td>
                                    <td style="width: 124px;">
                                        <div>
                                            <a href="{{ $team->url_facebook }}" target="_blank">Facebook</a>,
                                            <a href="http://twitter.com/{{ $team->url_twitter }}" target="_blank">Twitter</a>,
                                            <a href="http://instagram.com/{{ $team->url_instagram }}" target="_blank">Instagram</a>,
                                            <a href="{{ $team->url_linkedin }}" target="_blank">LinkedIn</a>
                                        </div>
                                    </td>
                                    <td style="width: 160px;">
                                        <a href="" class="btn btn-md btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                        <a href="" class="btn btn-md btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
                                    </td>
                                </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-4 col-lg-6">

            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Jabatan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="DTJabatan" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Jabatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jabatans as $jabatan)
                                        <tr>
                                            <td>{{ $jabatan->nama_jabatan }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Referensi Hasil</h6>
                        </div>
                        <div class="card-body">
                            <figure class="text-center">
                                <img src="{{ asset('sb-admin/reference/teams.png') }}" class="w-100" alt="" srcset="">
                                <figcaption>*Settings akan berdampak ke <a href="{{ route('public.about') }}" target="_blank">sini</a></figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>

    </div>

    <!-- Modal Team -->
    <div class="modal fade" id="tambahTeamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTeams">
                        <div class="mb-3">
                            <label for="nama_anggota" class="form-label">Nama Anggota</label>
                            <input type="text" class="form-control" name="nama_anggota" id="nama_anggota" placeholder="Nama Lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="jabatan_id" class="form-label">Jabatan</label>
                            <select name="jabatan_id" class="form-control" id="jabatan_id">
                                <option value="" style="display: none;">--- Pilih Jabatan ---</option>
                                @foreach ($jabatans as $jabatan)
                                <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="foto_anggota" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto_anggota" id="foto_anggota">
                        </div>
                        <div class="row mb-3" style="row-gap: 8px;">
                            <div class="col-6">
                                <div class="">
                                    <label for="url_facebook" class="form-label">Facebook</label>
                                    <input type="text" class="form-control" name="url_facebook" id="url_facebook" placeholder="Link facebook">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="">
                                    <label for="url_twitter" class="form-label">Twitter</label>
                                    <input type="text" class="form-control" name="url_twitter" id="url_twitter" placeholder="@username">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="">
                                    <label for="url_linkedin" class="form-label">LinkedIn</label>
                                    <input type="text" class="form-control" name="url_linkedin" id="url_linkedin" placeholder="Link linkedin">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="">
                                    <label for="url_instagram" class="form-label">Instagram</label>
                                    <input type="text" class="form-control" name="url_instagram" id="url_instagram" placeholder="@username">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-md btn-primary" id="btnSimpanTeam"><i class="fas fa-fw fa-save"></i> Simpan</button>
                        <button class="btn btn-md btn-secondary" type="reset"><i class="fas fa-fw fa-undo"></i>Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Jabatan -->
    <div class="modal fade" id="tambahJabatanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formJabatan">
                        <div class="mb-3">
                            <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                            <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" placeholder="cth: Manager">
                        </div>
                        <button class="btn btn-md btn-primary" id="btnSimpanJabatan"><i class="fas fa-fw fa-save"></i> Simpan</button>
                        <button class="btn btn-md btn-secondary" type="reset"><i class="fas fa-fw fa-undo"></i> Reset</button>
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
            $('#DTJabatan').DataTable();
        });

        /* EVENT TAMBAH ANGGOTA TEAM */
        $('body').on('click', '#btnTambahTeam', function (e) {
            e.preventDefault()
            $('#tambahTeamModal').modal('show')

            $('#formTeams').on('submit', function(e){
                e.preventDefault()
                e.stopImmediatePropagation()
                
                let formData = new FormData(this)
                $.ajax({
                    url: '{{ route('teams.store') }}',
                    method: 'POST',
                    headers :{
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if (response) {
                            // this.reset();
                            console.log(response);
                            // $('#tambahTeamModal').modal('hide');
                        }
                    },
                });
            })


        })

        /* EVENT TAMBAH JABATAN */
        $('body').on('click', '#btnTambahJabatan', function(e) {
            e.preventDefault()

            $('#btnSimpanJabatan').on('click', function(e) {
                e.preventDefault()
                e.stopImmediatePropagation()
                $.ajax({
                    url: '{{ route('katjab.store') }}',
                    method: 'POST',
                    data:{
                        _token: '{{ csrf_token() }}',
                        nama_jabatan: $('#nama_jabatan').val()
                    },success: (res) => {
                        $('#nama_jabatan').val('')
                        $('#tambahJabatanModal').modal('hide')
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: res.messages,
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        setTimeout(() => {
                            window.location.reload()
                        }, 2500);
                    },error: (err) => {
                        console.log(err);
                    }
                })
            })
        })
    
        
    // })
    </script>
@endpush