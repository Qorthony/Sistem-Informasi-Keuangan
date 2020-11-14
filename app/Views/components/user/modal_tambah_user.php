<!-- Modal -->
<div class="modal fade" id="tambahUser" tabindex="-1" aria-labelledby="tambahUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahUserLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/user/add" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="nip">NIP</label>
            <input type="text" name="nip" class="form-control" id="nip">
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email">
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <select name="keterangan" class="form-control" id="keterangan">
              <option value="1">Admin</option>
              <option value="2">Accounting</option>
              <option value="3">Board</option>
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