

<div class="row naik livesearchberanda">

<?php foreach($galerisa as $galeri): ?>
  <div class="col s6 m4 l3">
    <div class="card">
      <div class="card-image">
        <img class="materialboxed" src="<?= base_url(); ?>assets/img/galery/<?= $galeri['foto_galeri']; ?>" height="150">
        <a class="btn-floating halfway-fab waves-effect waves-light <?= $profil['tema_user']; ?> dropdown-trigger pilihmenugaleri" data-idgaleri="<?=$galeri['id_galeri'];?>" data-target="downgalery"><i class="material-icons">more_vert</i></a>
      </div>
      <div class="card-content">
        <p style="font-size:15px"><?= $galeri['deskripsi_galeri']; ?></p>
        <span style="font-size:11px" class="">by : <?= $galeri['nama_member']; ?></span>
      </div>
    </div>
  </div>
<?php endforeach; ?>

</div>