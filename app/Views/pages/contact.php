<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h4 class="m-0 font-weight-bold text-primary text-center">Kontak Kami</h4>
    </div>
    <div class="card-body">
        <div class="text-center">
        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="/img/pict-contact.svg" alt="...">
        <p>Sistem ini digunakan untuk mendata setiap barang yang ada di Laboratorium Informatika, di Universitas
            Muhammadiyah Sidoarjo
        </p>
        </div>
        <div class="text-right">
            <a href="https://storyset.com/">People illustrations by Storyset &rarr;</a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>