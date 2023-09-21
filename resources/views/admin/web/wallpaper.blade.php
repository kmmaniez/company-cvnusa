@extends('layouts.admin.master')
@push('assets')
    <link href="{{ url('sb-admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
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

                    <div class="table-responsive">
                        <table class="table table-bordered" id="DTWallpapers" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Wallpaper Section</th>
                                    <th>Gambar</th>
                                    <th>Action</th>
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

    <!-- Modal Wallpaper -->
    <div class="modal fade" id="modalWallpaper" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form {{ $title }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formUpdateWallpaper">
                        <div class="mb-3">
                            <label for="wallpaper_image" class="form-label">Wallpaper Website</label>
                            <img id="preview-wallpaper" alt="" srcset="">
                            <input type="file" class="form-control" name="wallpaper_image" id="wallpaper_image">
                            <span class="text-danger" id="wallpaper-input-error"></span>
                        </div>
                        <button class="btn btn-md btn-primary" id="btnUpdateWallpaper"><i
                                class="fas fa-fw fa-save"></i>Update</button>
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
        let idWall;

        // $(document).ready(function() {
        /* EVENT MODAL DITUTUP */
        $('#modalWallpaper').on('hidden.bs.modal', function(e) {
            $('#preview-wallpaper').css({
                display: 'none',
            })
        })
        // });

        /* EVENT SHOW WALLPAPER */
        $('#wallpaper_image').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-wallpaper').attr('src', e.target.result);
                $('#preview-wallpaper').css({
                    display: 'block',
                    width: '300px',
                    height: '150px',
                    marginBottom: '8px',
                })
            }
            reader.readAsDataURL(this.files[0]);
        });

        /* EVENT EDIT WALLPAPER */
        $('body').on('click', '#btnEditWallpaper', function(e) {
            e.preventDefault()

            $('#modalWallpaper').modal('show');
            idWall = $(this).data('wall')

            $('#formUpdateWallpaper').on('submit', function(e) {

                e.preventDefault()
                e.stopImmediatePropagation()

                let formData = new FormData(this)
                formData.append('_method', 'PATCH')
                $.ajax({
                    url: window.location.pathname + '/' + idWall,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $('#modalWallpaper').modal('hide');
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: res.message,
                            showConfirmButton: false,
                            timer: 2500,
                        });
                        $('#DTWallpapers').DataTable().ajax.reload()
                    }
                })

            })
        })

        /* INISIALISASI DATATABLE */
        $('#DTWallpapers').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('wallpaper.getallwallpaper') }}",
            columns: [{
                    data: 'section_name',
                    name: 'name'
                },
                {
                    data: 'wallpaper_image',
                    name: 'wallpaper'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            searching: false,
            paging: false,
        });
    </script>
@endpush
