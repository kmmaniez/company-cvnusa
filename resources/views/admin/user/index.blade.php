@extends('layouts.admin.master')
@push('assets')
    <link href="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        input.form-control.is-invalid:focus{
            /* background-color: red; */
            box-shadow: none;
            border: 1px solid #ff887d;
        }
    </style>
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
                    <a href="" class="btn btn-md btn-primary mb-3" id="btnTambahUser" data-toggle="modal" data-target="#modalUser"><i
                            class="fas fa-fw fa-plus"></i> Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="DTUsers" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Nama Lengkap</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Tanggal Dibuat | Diubah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- CRUD Modal User -->
    <div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Modal User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCreateUser">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="cth: Adinda Maharani" required>
                            <span class="text-danger" id="name-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="cth: adminkeren" required>
                            <span class="text-danger" id="username-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="cth: mailmu@gmail.com" required>
                            <span class="text-danger" id="email-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role <small><i>(default: writer)</i></small></label>
                            <select class="form-control" name="role" id="role">
                                <option data-name="writer" value="writer">Writer</option>
                                <option data-name="admin" value="admin">Admin</option>
                                <option data-name="super" value="super">Super Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="" required>
                            <span class="text-danger" id="password-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="password_conf" class="form-label">Password Konfirmasi</label>
                            <input type="password" class="form-control" name="password_conf" id="password_conf" placeholder="" required>
                            <span class="text-danger" id="passwordconf-error"></span>
                        </div>
                        <button class="btn btn-md btn-primary" id="btnSimpanUser"><i class="fas fa-fw fa-save"></i>Simpan</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
        let ids;

        $(document).ready(function() {
            $('#modalUser').on('hidden.bs.modal', function (e) {
                resetFormInput();
                removeInvalidText();                
                removeInvalidClass();
            })
        });

        /* EVENT KETIK PASSWORD KONFIRMASI */
        $('#password_conf').on('keyup', function(e) {
            if ($(this).val() !== $('#password').val()) {
                $('#password_conf').addClass('is-invalid');
                $('#passwordconf-error').text('Password tidak sama');
            }else{
                removeInvalidClass()
                removeInvalidText()
            }
        })

        /* EVENT TAMBAH USER */
        $('body').on('click', '#btnTambahUser', function() {

            $('#modalUser').modal('show');

            $('#username').on('change',function(e){
                checkUsernameOrEmailIsExsits('username', $(this).val())
            })

            $('#email').on('change',function(e){
                checkUsernameOrEmailIsExsits('email', $(this).val())
            })

            $('#btnSimpanUser').click(function(e) {
                e.preventDefault()
                e.stopImmediatePropagation();

                removeInvalidClass()
                removeInvalidText()

                $.ajax({
                    url: '{{ route('users.store') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: $('#name').val(),
                        username: $('#username').val(),
                        email: $('#email').val(),
                        role: $('#role').val(),
                        password: $('#password').val(),
                    },
                    success: (res) => {
                        displaySweetAlert('success','success', res.message)
                        resetFormInput()
                        $('#DTUsers').DataTable().ajax.reload();
                        $('#modalUser').modal('hide');
                    },
                    error: function(res) {
                        const {errors} = res.responseJSON;
                        if (errors.name) {
                            $('#name').addClass('is-invalid');
                            $('#name-error').text(errors.name[0]);
                        }
                        if (errors.username) {
                            $('#username').addClass('is-invalid');
                            $('#username-error').text(errors.username[0])
                        }
                        if (errors.email) {
                            $('#email').addClass('is-invalid');
                            $('#email-error').text(errors.email[0])
                        }
                        if (errors.password) {
                            $('#password').addClass('is-invalid');
                            $('#password_conf').addClass('is-invalid');
                            $('#password-error').text(errors.password[0]);
                            $('#passwordconf-error').text('Password konfirmasi wajib diisi');
                        }
                    }
                })
            })

        })

        /* EVENT EDIT USER */
        $(document).ready(function(){

            $('body').on('click', '#btnEditUser', function(e) {
                    e.preventDefault()

                    $('#modalUser').modal('show');
                    userId = $(this).data('user');
                    
                    $('#username').on('change',function(e){
                        checkUsernameOrEmailIsExsits('username', $(this).val(), userId)
                    })
                    
                    $('#email').on('change',function(e){
                        checkUsernameOrEmailIsExsits('email', $(this).val(), userId)
                    })
        
                    /* FUNGSI UNTUK GET USER BY ID */
                    $.ajax({
                        url: window.location.pathname+'/getuser/'+userId,
                        method: 'GET',
                        success: (res) => {
                            const {data} = res
                            $('#role').val(data.roles)
                            $('#name').val(data.name);
                            $('#username').val(data.username);
                            $('#password').val(data.password);
                            $('#email').val(data.email);
                        },
                        error: function(res) {
                            const {errors} = res.responseJSON;
                            if (errors.name) {
                                $('#name').addClass('is-invalid');
                                $('#name-error').text(errors.name[0]);
                            }
                            if (errors.username) {
                                $('#username').addClass('is-invalid');
                                $('#username-error').text(errors.username[0])
                            }
                            if (errors.email) {
                                $('#email').addClass('is-invalid');
                                $('#email-error').text(errors.email[0])
                            }
                            if (errors.password) {
                                $('#password').addClass('is-invalid');
                                $('#password_conf').addClass('is-invalid');
                                $('#password-error').text(errors.password[0]);
                                $('#passwordconf-error').text('Password konfirmasi wajib diisi');
                            }
                        }
                    })
        
                    $('#btnSimpanUser').click(function(e) {
                        e.preventDefault()
                        e.stopImmediatePropagation();
        
                        removeInvalidClass();
                        removeInvalidText();
        
                        $.ajax({
                            url: window.location.pathname+'/'+userId,
                            method: 'PATCH',
                            data: {
                                _token: '{{ csrf_token() }}',
                                name: $('#name').val(),
                                username: $('#username').val(),
                                email: $('#email').val(),
                                role: $('#role').val(),
                                password: $('#password').val(),
                            },
                            success: (res) => {
                                displaySweetAlert('success','success', res.message)
                                resetFormInput();
                                $('#DTUsers').DataTable().ajax.reload();
                                $('#modalUser').modal('hide');
                            },
                            error: function(res) {
                                const {errors} = res.responseJSON;
                                if (errors.name) {
                                    $('#name').addClass('is-invalid');
                                    $('#name-error').text(errors.name[0]);
                                }
                                if (errors.username) {
                                    $('#username').addClass('is-invalid');
                                    $('#username-error').text(errors.username[0])
                                }
                                if (errors.email) {
                                    $('#email').addClass('is-invalid');
                                    $('#email-error').text(errors.email[0])
                                }
                                if (errors.password) {
                                    $('#password').addClass('is-invalid');
                                    $('#password_conf').addClass('is-invalid');
                                    $('#password-error').text(errors.password[0]);
                                    $('#passwordconf-error').text('Password konfirmasi wajib diisi');
                                }
                            }
                        })
                    })
            })

        })

        /* EVENT HAPUS USER */
        $('body').on('click', '#btnHapusUser', function(e) {
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
                        url: window.location.pathname+'/destroy/'+$(this).data('user'),
                        method: 'DELETE',
                        cache: false,
                        data:{
                            _token: '{{ csrf_token() }}',
                            id: $(this).data('user')
                        },
                        success:function(res){ 
                            displaySweetAlert('success','success', res.message, 2500)
                            $('#DTUsers').DataTable().ajax.reload();
                        }
                    });
                    }
            })
        })

        /* FUNGSI RESET INPUT */
        function resetFormInput() {
            $('#name').val('');
            $('#username').val('');
            $('#email').val('');
            $('#password').val('');
            $('#password_conf').val('');
            $('#role').val('writer');
        }

        /* FUNGSI HAPUS TEXT INVALID */
        function removeInvalidText() {
            $('#name-error').text('')
            $('#username-error').text('')
            $('#email-error').text('')
            $('#password-error').text('')
            $('#passwordconf-error').text('')
        }

        /* FUNGSI HAPUS CLASS INVALID */
        function removeInvalidClass() {
            $('#name').removeClass('is-invalid');
            $('#username').removeClass('is-invalid');
            $('#email').removeClass('is-invalid');
            $('#password').removeClass('is-invalid');
            $('#password_conf').removeClass('is-invalid');
        }
        
        /* FUNGSI UNTUK MENAMPILKAN SWEETALERT */
        function displaySweetAlert(type, icon, title, buttonconfirm = false, timer = 2500) {
            Swal.fire({
                type: type,
                icon: icon,
                title: title,
                showConfirmButton: false,
                timer: timer,
            });
        }

        /* FUNGSI UNTUK CEK USERNAME/EMAIL TERSEDIA */
        function checkUsernameOrEmailIsExsits(type, value, userid) {
            const url = '{{ route('users.checkmailusername') }}';
            const urlWithQuery = window.location.pathname+'/checkmail/'+userid+'?'+type+'='+value;

            switch (type) {
                case 'username':
                        $.ajax({
                            url: (!userid) ? url : urlWithQuery,
                            method: 'GET',
                            data:{
                                username: value
                            },
                            success: (res) => {
                                if (res.message === undefined) {
                                    $('#username-error').text('')
                                }
                                $('#username-error').text(res.message)
                            },
                            error: function(res) {
                                console.error(res);
                            }
                        })
                    break;
                case 'email':
                        $.ajax({
                            url: (!userid) ? url : urlWithQuery,
                            method: 'GET',
                            data:{
                                email: value
                            },
                            success: (res) => {
                                if (res.message === undefined) {
                                    $('#email-error').text('')
                                }
                                $('#email-error').text(res.message)
                            },
                            error: function(res) {
                                console.error(res);
                            }
                        })
                default:
                    break;
            }
        }

        /* INISIALISASI DATATABLE */
        $('#DTUsers').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('users.getusers') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'username', name: 'username'},
                  {data: 'email', name: 'email'},
                  {data: 'role', name: 'role'},
                  {data: 'updated_at', name: 'created_at'},
                  {
                      data: 'action', 
                      name: 'action', 
                      orderable: false, 
                      searchable: false
                  },
              ],
              "language": {
                    "processing": "<div class=\"spinner-border bg-transparent\" role=\"status\"></div>"
                }
        });
    </script>
@endpush
