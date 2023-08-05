<!-- CRUD Modal Category -->
<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    </div>
                    <button class="btn btn-md btn-primary" id="btnSimpanKat"><i class="fas fa-fw fa-save"></i>
                        Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('body').on('click', '#btnKatCreate', function() {

            $('#modal-create').modal('show');

            $('#btnSimpanKat').click(function(e) {
                e.preventDefault()
                e.stopImmediatePropagation();
                $.post('{{ route('kategori.store') }}', {
                    _token: '{{ csrf_token() }}',
                    nama_kategori: $('#nama_kategori').val(),
                }, function(data, status) {
                    if (status === 'success') {
                        console.log(data);
                        $('#modal-create').modal('hide');
                        $('#kategoriDT').DataTable().ajax.reload();
                        $('#nama_kategori').val('');
                    } else {
                        console.log(status);
                    }
                })
            })
        })
    </script>
@endpush
