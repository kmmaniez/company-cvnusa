<!-- CRUD Modal Category -->
<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="update_nama_kat" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="update_nama_kat" id="update_nama_kat" placeholder="Rumah Sakit">
                    </div>
                    <button class="btn btn-md btn-primary" id="btnUpdateKat"><i class="fas fa-fw fa-save"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('body').on('click', '#btnKatEdit', function(){
            $('#modal-update').modal('show');
            let id = $(this).data('kat');
            const url = '{{ route('categories.index') }}'
            $.get(url+'/'+id, 
                function ({data}, success) {
                    $('#update_nama_kat').val(data.nama_kategori)
                    $('#btnUpdateKat').data('kat',data.id);
                }
            )
        })
        
        $('#btnUpdateKat').click(function (e){
            e.preventDefault()
            const id = $(this).data('kat')
            $.post(`${window.location.pathname}/${id}`, {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                nama_kategori : $('#update_nama_kat').val()
            }, function(data, status) {
                if (status === 'success') {
                    console.log(data);
                    $('#modal-update').modal('hide');
                    $('#kategoriDT').DataTable().ajax.reload();
                    $('#update_nama_kat').val('')
                }
            })
        })

        $('body').on('click', '#btnKatDelete', function(){
            const id = $(this).data('kat')
            $.post(`/kategori/${id}`, {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE',
            }, function(data, status) {
                if (status === 'success') {
                    console.log(data);
                    window.location.reload()
                }
            })
        })
    </script>
@endpush