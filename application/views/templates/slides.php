<div class="slider naik">
  <ul class="slides">
    <?php foreach($galerislimit as $galeril): ?>
    <li>
      <img src="<?= base_url(); ?>assets/img/galery/<?= $galeril['foto_galeri']; ?>"> <!-- random image -->
      <div class="caption center-align" style="text-shadow:1px 2px 1px black">
        <h3><?= ucwords($galeril['deskripsi_galeri']); ?></h3>
        <h5 class="light grey-text text-lighten-3"><?= 'By : '.ucwords($galeril['nama_member']); ?></h5>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
</div>