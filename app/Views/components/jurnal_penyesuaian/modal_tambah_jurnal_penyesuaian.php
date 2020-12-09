<?php

use CodeIgniter\I18n\Time;
?>
<!-- Modal -->
<div class="modal fade" id="tambahJurnalPenyesuaian" tabindex="-1" aria-labelledby="tambahJurnalPenyesuaianLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahJurnalPenyesuaianLabel">Tambah Jurnal Penyesuaian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/jurnal_penyesuaian/add" method="POST">
        <div class="modal-body">
          <div class="form-group">
              <label for="tanggal">Tanggal</label>
              <input type="date" name="tanggal" value="<?= Time::now()->getYear()."-".Time::now()->getMonth()."-".Time::now()->getDay() ?>" class="form-control" id="tanggal">
          </div>
          <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <input type="text" name="keterangan" class="form-control" id="keterangan">
          </div>
          <div class="form-group">
              <label for="akun">Akun</label>
              <select name="akun" id="akun" class="form-control">
                <?php foreach ($akuns as $akun) {?>
                  <option value="<?= $akun['no_akun'] ?>"><?= $akun['nama_akun'] ?></option>
                <?php } ?>
              </select>
          </div>
          <div class="form-group">
              <label for="debit">Debet</label>
              <input type="number" name="debit" class="form-control" id="debit">
          </div>
          <div class="form-group">
              <label for="kredit">Kredit</label>
              <input type="number" name="kredit" class="form-control" id="kredit">
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