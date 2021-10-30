<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card mb-4">
    <div class="card-body">
        <h6 class="m-0 font-weight-bold text-primary">IT - SUPPORT</h6>
        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="/img/pict-ictbidus.svg" alt="...">
        </div>
        <p class="text-center">Sistem ini kami gunakan untuk mendata setiap barang yang ada di Divisi IT-SUPPORT pada Laboratorium Informatika, Universitas
            Muhammadiyah Sidoarjo
        </p> 
    </div>
</div>

<!-- Data It-Support -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="/itsupport/create" class=" font-weight-bold btn btn-primary">Tambah Data</a>
        <br>
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="card mt-2 mb-2 py-3 border-left-success">
                <div class="card-body">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            </div>
        <?php endif ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1; ?>
                    <?php foreach ($itsupport as $itsupport) : ?>
                        <tr>
                            <th scope="row"><?= $n++; ?></th>
                            <td><?= $itsupport['nama']; ?></td>
                            <td><?= $itsupport['jumlah']; ?></td>
                            <td><?= $itsupport['keterangan']; ?></td>
                            <td><?= $itsupport['created_at']; ?></td>
                            <td>
                                <a href="/itsupport/edit/<?= $itsupport['id']; ?>" class="btn btn-warning btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>


                                <form action="/itsupport/<?= $itsupport['id']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-icon-split" onclick="return confirm('Apakah anda yakin?')">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Hapus</span>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>