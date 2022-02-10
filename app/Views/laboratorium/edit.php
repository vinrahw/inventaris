<?php

use App\Controllers\laboratorium;
?>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col-8">
      <h4 class="my-3">Form Ubah Data Ruang Lab</h4>

      <form action="/laboratorium/update/<?= $laboratorium->id ?>" method="post">
        <?= csrf_field(); ?>

        <input type="hidden" class="form-control" name="id" value="<?= $laboratorium->id ?>">

        <div class="row mb-3">
          <label for="nama" class="col-sm-2 col-form-label">Nama</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= ($validation->hasError('nama')) ?
                                                      'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= $laboratorium->nama ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
              <?= $validation->getError('nama'); ?>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= ($validation->hasError('jumlah')) ?
                                                      'is-invalid' : ''; ?>" id="jumlah" name="jumlah" value="<?= $laboratorium->jumlah ?>">

            <div id="validationServer03Feedback" class="invalid-feedback">
              <?= $validation->getError('jumlah'); ?>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="nama" class="col-sm-2 col-form-label">Spesifikasi</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= ($validation->hasError('spesifikasi_lab')) ?
                                                      'is-invalid' : ''; ?>" id="spesifikasi_lab" name="spesifikasi_lab" autofocus value="<?= $laboratorium->spesifikasi_lab ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
              <?= $validation->getError('spesifikasi_lab'); ?>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="cctv" class="col-sm-2 col-form-label">CCTV</label>
          <div class="col-sm-10">
            <select id="cctv" name="cctv" class="" <?= ($validation->hasError('cctv')) ?
                                                      'is-invalid' : ''; ?>" id="cctv" name="cctv" value="<?= old('cctv'); ?>">>
              <option value="Ada">Ada</option>
              <option value="Tidak Ada">Tidak Ada</option>
            </select>
            <div id="validationServer03Feedback" class="invalid-feedback">
              <?= $validation->getError('cctv'); ?>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= ($validation->hasError('keterangan')) ?
                                                      'is-invalid' : ''; ?>" id="keterangan" name="keterangan" value="<?= $laboratorium->keterangan ?>">

            <div id="validationServer03Feedback" class="invalid-feedback">
              <?= $validation->getError('keterangan'); ?>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Ubah Data</button>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>