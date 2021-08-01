<div class="minheight" style="min-height: 300px;">

<?php if($margintop=='50px'){ ?>
<div class="row naik setulang" style="margin-top:40px">
  <div class="col s12 center-align">
    <h5 class="gf">Galleri Foto</h5>
    <hr style="width:50%;margin-top:5px;margin-bottom:-5px;border:2px solid gray;">
  </div> 
</div>
<?php }else{ ?>
<div class="row naik">
  <div class="col s12 center-align">
    <h5 class="gf">Galleri Foto</h5>
    <hr style="width:50%;margin-top:10px;margin-bottom:-5px;border:2px solid gray;">
  </div> 
</div>
<?php } ?>

<?php if($margintop=='50px'){ ?>
<div class="row naik setulanggambar livesearchberanda" style="padding-bottom: 10px;max-width: 1000px">
<?php }else{ ?>
<div class="row naik livesearchberanda" style="padding-bottom: 10px;max-width: 1000px">
<?php } ?>
<?=$this->session->flashdata('message'); ?>
<?php if(!$galeris){ ?>
  <h5 class="center-align" style="padding: 15px;">Data tidak ditemukan!</h5>
<?php }else{ ?>
<?php foreach($galeris as $galeri): ?>
  <div class="col s6 m4 l3">
    <div class="card">
      <div class="card-image">
        <img class="materialboxed" src="<?= base_url(); ?>assets/img/galery/<?= $galeri['foto_galeri']; ?>" height="150">
      <?php if($this->session->userdata('level_user')=='admin'): ?>
        <a class="btn-floating halfway-fab waves-effect waves-light <?= $profil['tema_user']; ?> dropdown-trigger pilihmenugaleri" data-idgaleri="<?=$galeri['id_galeri'];?>" data-target="downgalery"><i class="material-icons">more_vert</i></a>
      <?php endif; ?>
      </div>
      <div class="card-content" style="padding-bottom: 10px;">
        <p style="font-size:15px"><?= ucwords($galeri['deskripsi_galeri']); ?> 
          <?php if($galeri['id_galeri']==$this->session->flashdata('newnotif')){ ?> <span class="red-text"> New update </span> <?php } ?>
          <?php if($galeri['id_galeri']==$this->session->flashdata('newnotiftambah')){ ?> <span class="red-text"> New galeri </span> <?php } ?>
        </p>
        <span style="font-size:12px;color:#757575;" class="">By : <?= ucwords($galeri['nama_member']); ?></span>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<?php } ?>

</div>

</div><!--tutup minheight-->
<?php if($this->session->userdata('level_user')=='admin'): ?>
<!-- Dropdown Structure -->
<ul id='downgalery' class='dropdown-content z-depth-3'>
  <li><a class="modal-trigger editgaleriinfo"  href="#modaleditgaleri">edit</a></li>
  <li><a class="hapusgalerifoto" onclick="return confirm('klik OK untuk hapus!')">hapus</a></li>
</ul>


<div class="fixed-action-btn">
  <a class="btn-floating btn-large modal-trigger waves-effect waves-light z-depth-3 <?= $profil['tema_user']; ?> modaltambahgaleri" href="#modaltambahgaleri">
    <i class="large material-icons">add_photo_alternate</i>
  </a>
</div>


<!-- Modal edit galeri-->
<div id="modaleditgaleri" class="modal">
  <div class="container" style="font-size: 15px;font-weight: bold;">
    <div class="row kurangi" style="padding-bottom: 0">
      <div class="col s8">
        <p>Edit Galeri Foto</p>
      </div>
      <div class="col s4">
        <div class="preloader-wrapper small active loader right" style="height: 25px;width: 25px;top:12px">
          <div class="spinner-layer spinner-red-only">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div><div class="gap-patch">
              <div class="circle"></div>
            </div><div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="">
  <form action="<?= base_url('admin/editgaleri'); ?>" method="post" enctype="multipart/form-data">
  <div class="modal-content" style="margin-top: -50px">

    <div class="row">
      <div class="col s12">
        <img class="materialboxed datafotogalerilama" width="100%" height="150">
      </div>
    </div>

    <input type="hidden" name="editgalerilama" class="editgalerilama">

    <div class="row">
      <span class="right" style="font-size:12px;font-style:italic;margin-top: -15px">jpg,png,gif dibawah 2mb</span>
    <div class="file-field input-field col s12" style="margin-top: -2px">
      <div class="btn <?= $profil['tema_user']; ?>">
        <span>File</span>
        <input type="file" name="fotogaleriedit" class="fotogaleriedit" multiple>
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate hilangvalue" type="text" placeholder="Klik untuk pilih file">
      </div>
    </div>
    </div>

    <div class="row">
      <div class="input-field col s12" style="margin-top: -15px">
        <input id="ubahdes" type="text" name="deskripsigaleriedit" class="validate deskripsigaleriedit" autocomplete="off" required>
        <label for="ubahdes" class="labelaktif">Deskripsi</label>
      </div>
    </div>
    
    <div class="row">
    <div class="input-field col s12" style="margin-top: -15px">
      <select class="icons pilihmemberedit" name="pilihmemberedit" required>
        <option value="" disabled selected>Ganti member</option>
      <?php foreach($choses as $chose): ?>
        
        <option value="<?= $chose['id_member']; ?>" data-icon="<?= base_url('assets/img/anggota/').$chose['foto_member']; ?>" class="select<?=$chose['id_member'];?>"><?= $chose['nama_member']; ?></option>
        
      <?php endforeach; ?>
      </select>
    </div>
    </div>

  </div>
  <div class="modal-footer" style="margin-top: -35px">
    <div class="container">
    <button type="submit" name="tambahgaleriedit" class="waves-effect <?= $profil['tema_user']; ?> waves-light btn-small tambahgaleriedit">simpan</a>
    </div>
  </div>
  </div>
  </form>

</div>


<!-- Modal tambah galeri-->
<div id="modaltambahgaleri" class="modal">
  <div class="container" style="font-size: 15px;font-weight: bold;">
    <div class="row kurangi" style="padding-bottom: 0">
      <div class="col s8">
        <p>Tambah Galeri Foto</p>
      </div>
      <div class="col s4">
        <div class="preloader-wrapper small active loader right" style="height: 25px;width: 25px;top:12px">
          <div class="spinner-layer spinner-red-only">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div><div class="gap-patch">
              <div class="circle"></div>
            </div><div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="">
  <form action="<?= base_url('admin/uploadgaleri'); ?>" method="post" enctype="multipart/form-data">
  <div class="modal-content" style="margin-top: -50px;">

    <div class="row" style="">
      <span class="right" style="font-size:12px;font-style:italic;">jpg,png,gif dibawah 2mb</span>
    <div class="file-field input-field col s12">
      <div class="btn <?= $profil['tema_user']; ?>">
        <span>File</span>
        <input type="file" name="fotogaleri" class="fotogaleri" multiple required>
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate hilangvaluetext" type="text" placeholder="Klik untuk pilih file" required>
      </div>
    </div>
    </div>

    <div class="row">
      <!-- <span class="right" style="font-size:12px;font-style:italic;">Tidak boleh kosong</span> -->
      <div class="input-field col s12" style="margin-top: -15px">
        <input id="deskripsi" class="deskripsi validate" type="text" name="deskripsigaleri" autocomplete="off" required>
        <label for="deskripsi">Deskripsi</label>
      </div>
    </div>
    
    <div class="row">
      <!-- <span class="right" style="font-size:12px;font-style:italic;">Pilih ulang</span> -->
    <div class="input-field col s12" style="margin-top: -15px">
      <select class="icons pilihmember" name="pilihmember"  required>
        <option value="" disabled selected>Pilih member</option>
      <?php foreach($choses as $chose): ?>
        <option value="<?= $chose['id_member']; ?>" data-icon="<?= base_url('assets/img/anggota/').$chose['foto_member']; ?>"><?= $chose['nama_member']; ?></option>
      <?php endforeach; ?>
      </select>
    </div>
    </div>

  </div>
  <div class="modal-footer" style="margin-top: -35px">
    <div class="container">
    <button type="submit" name="tambahgaleri" class="waves-effect <?= $profil['tema_user']; ?> waves-light btn-small tambahgaleri">tambah</a>
    </div>
  </div>
  </div>
  </form>

</div>

<?php endif; ?>

<div class="div" style="height: 10px"></div>
