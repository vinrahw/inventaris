<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card mb-4">
  <div class="card-body">
    <h6 class="m-0 font-weight-bold text-primary">LAB - GAME DAN MULTIMEDIA</h6>
    <div class="text-center">
      <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="/img/pict-ictbidus.svg" alt="...">
    </div>
    <p class="text-center">Sistem ini digunakan untuk mendata setiap barang yang ada di Laboratorium Informatika, di Universitas
      Muhammadiyah Sidoarjo
    </p>
  </div>
</div>

<!-- DataLab -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="/labgamed/create" class=" font-weight-bold btn btn-primary">Tambah Data</a>
    <br>
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
            <th>Spesifikasi Lab</th>
            <th>CCTV</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $n = 1; ?>
          <?php foreach ($labgamed as $gamed) : ?>
            <tr>
              <th scope="row"><?= $n++; ?></th>
              <td><?= $gamed['nama']; ?></td>
              <td><?= $gamed['jumlah']; ?></td>
              <td><?= $gamed['spesifikasi_lab']; ?></td>
              <td><?= $gamed['cctv']; ?></td>
              <td><?= $gamed['keterangan']; ?></td>
              <td><?= $gamed['created_at']; ?></td>
              <td>
                <a href="/labgamed/edit/<?= $gamed['id']; ?>" class="btn btn-warning btn-icon-split">
                  <span class="icon text-white-50">
                    <i class="fas fa-exclamation-triangle"></i>
                  </span>
                  <span class="text">Edit</span>
                </a>


                <form action="/labgamed/delete/<?= $gamed['id']; ?>" method="post" class="d-inline">
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