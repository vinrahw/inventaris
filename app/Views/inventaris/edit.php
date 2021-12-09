<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h4 class="my-3">Form Ubah Data Bidus</h4>

            <form action="/inventaris/update/<?= $inventaris->id ?>" method="post">
                <?= csrf_field(); ?>

                <input type="hidden" class="form-control" name="id" value="<?= $inventaris->id ?>">

                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ?
                                                                    'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= $inventaris->nama ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('jumlah')) ?
                                                                    'is-invalid' : ''; ?>" id="jumlah" name="jumlah" value="<?= $inventaris->jumlah ?>">

                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('jumlah'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="keterangan" class="col-sm-2 col-form-label">Kondisi</label>
                    <div class="col-sm-10">
                        <select id="kondisi" name="cctv" class="" <?= ($validation->hasError('kondisi')) ?
                                                                        'is-invalid' : ''; ?>" id="kondisi" name="kondisi" value="<?= old('kondisi'); ?>">>
                            <option value="Ada">Baik</option>
                            <option value="Ada">Buruk</option>
                            <option value="Ada">Hilang</option>
                            <option value="Tidak Ada">Rusak</option>
                        </select>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('kondisi'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('keterangan')) ?
                                                                    'is-invalid' : ''; ?>" id="keterangan" name="keterangan" value="<?= old('keterangan'); ?>">

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