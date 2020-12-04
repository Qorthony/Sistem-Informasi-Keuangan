<!-- Modal -->
<div class="modal fade" id="tambahJurnalUmum" tabindex="-1" aria-labelledby="tambahJurnalUmumLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahJurnalUmumLabel">Tambah Jurnal Umum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/jurnal_umum/add" method="POST">
        <div class="modal-body">
          <div class="form-group">
              <label for="tanggal">Tanggal</label>
              <input type="date" name="start" value="<?= CodeIgniter\I18n\Time::now()->getYear() . "-" . CodeIgniter\I18n\Time::now()->getMonth() ?>" max="<?= CodeIgniter\I18n\Time::now()->getYear() . "-" . CodeIgniter\I18n\Time::now()->getMonth() ?>" class="form-control" id="start">
          </div>
          <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <input type="text" name="keterangan" class="form-control" id="keterangan_transaksi">
          </div>
          <div class="form-group">
              <label for="no_akun">No Akun</label>
              <input type="text" name="no_akun" class="form-control" id="no_akun">
          </div>
          <div class="form-group">
              <label for="debit">Debet</label>
              <input type="text" name="debit" class="form-control" id="debit">
          </div>
          <div class="form-group">
              <label for="kredit">Kredit</label>
              <input type="text" name="kredit" class="form-control" id="kredit">
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