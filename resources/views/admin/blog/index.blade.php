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
                    <a href="{{ route('blogs.create') }}" id="btnTambahTeam" class="btn btn-md btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="DTPosts" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Judul</th>
                                    <th>Slug</th>
                                    <th>Thumbnail</th>
                                    <th>Penulis</th>
                                    <th>Kategori</th>
                                    <th>Dibuat | Diupdate</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dump($blog) --}}
                                {{-- @forelse ($blog as $data)
                                <tr>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->slug }}</td>
                                    <td>{{ $data->thumbnail }}</td>
                                    <td><span class="badge badge-primary p-2" style="border-radius: 0%">{{ $data->users->name }}</span></td>
                                    <td>{{ $data->kategoris->nama_kategori }}</td>
                                    <td>{{ $data->title }}</td>
                                </tr>
                                @empty
                                    
                                @endforelse --}}
                            </tbody>
                        </table>
                    </div>
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
        /* INISIALISASI DATATABLE */
        $('#DTPosts').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('blogs.getdataposts') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'id'},
                  {data: 'title', name: 'title'},
                  {data: 'slug', name: 'slug'},
                  {data: 'thumbnail', name: 'thumbnail'},
                  {data: 'user_id', name: 'user'},
                  {data: 'kategori_id', name: 'kategori'},
                  {data: 'updated_at', name: 'published_at'},
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