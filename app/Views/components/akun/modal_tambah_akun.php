<!-- Modal -->
<div class="modal fade" id="tambahAkun" tabindex="-1" aria-labelledby="tambahAkunLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahAkunLabel">Tambah Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/akun/add" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="no_akun">No Akun</label>
            <input type="text" name="no akun" class="form-control" id="no_akun">
          </div>
          <div class="form-group">
            <label for="nama_akun">Nama Akun</label>
            <input type="text" name="nama akun" class="form-control" id="nama_akun">
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" id="keterangan">
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Tambah</button>
          <button type="button" class="btn btn-light" data-dismiss="modal">Keluar</button>
        </div>
      </form>
    </div>
  </div>
</div>