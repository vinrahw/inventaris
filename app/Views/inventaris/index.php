<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card mb-4">

    <!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="img-fluid px-3  d-block w-50" src="/img/pict-ictbidus.svg" alt="...">
            </div>
            <div class="carousel-item">
                <img class="img-fluid px-3  d-block w-50" src="/img/pict-contact.svg" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/img/pict-contact.svg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> -->

    <div class="card-body">
        <h6 class="m-0 font-weight-bold text-primary">ICT - BIDUS</h6>
        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="/img/pict-ictbidus.svg" alt="...">
        </div>
        <p class="text-center">Sistem ini digunakan untuk mendata setiap barang yang ada di Laboratorium Informatika, di Universitas
            Muhammadiyah Sidoarjo
        </p>
    </div>
</div>

<!-- DataBidus -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="/inventaris/create" class=" font-weight-bold btn btn-primary">Tambah Data</a>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="card mt-2 mb-2 py-3 border-left-success">
                <div class="card-body text-primary">
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
                        <th>Kondisi</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>


                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1; ?>
                    <?php foreach ($inventaris as $i) : ?>
                        <tr>
                            <th scope="row"><?= $n++; ?></th>
                            <td><?= $i['nama']; ?></td>
                            <td><?= $i['jumlah']; ?></td>
                            <td><?= $i['kondisi']; ?></td>
                            <td><?= $i['keterangan']; ?></td>
                            <td><?= $i['created_at']; ?></td>
                            <td>
                                <a href="/inventaris/edit/<?= $i['id']; ?>" class="btn btn-warning btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>


                                <form action="/inventaris/<?= $i['id']; ?>" method="post" class="d-inline">
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