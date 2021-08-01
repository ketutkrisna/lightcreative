<div class="navbar-fixed pencarian" style="margin-top: -62px;">
  <nav class="<?= $profil['tema_user']; ?>">
    <div class="nav-wrapper">
      
      <?php if($title=='beranda'){ ?>
      <form action="<?=base_url('users/index'); ?>" method="post">
        <div class="input-field">
          <input id="search" type="search" name="inputcarigaleri" class="inputcari" value="<?=$valuecari;?>" autocomplete="off" placeholder="Deskripsi atau nama member..">
          <label class="label-icon" for="search"><i class="material-icons batal">close</i></label>
          <button class="material-icons <?= $profil['tema_user']; ?>" type="submit" name="caridatagaleri" style="height:100%;border:0;right:0;padding-right:10px;padding-left:10px;color:white;"><i class="material-icons">search</i></button>
        </div>
      </form>
      <?php }else if($title=='pemesanan'){ ?>
      <form action="<?=base_url('users/pemesanan'); ?>" method="post">
        <div class="input-field">
          <input id="search" type="search" name="inputcaridatamember" class="inputcaridatamember" value="<?=$valuecari;?>" autocomplete="off" placeholder="Nama,bidang atau alamat..">
          <label class="label-icon" for="search"><i class="material-icons batal">close</i></label>
          <button class="material-icons <?= $profil['tema_user']; ?>" type="submit" name="caridatamember" style="height:100%;border:0;right:0;padding-right:10px;padding-left:10px;color:white;"><i class="material-icons caridatamember">search</i></button>
        </div>
      </form>
      <?php }else if($title=='notifikasi'){ ?>
      <form action="<?=base_url('admin/index'); ?>" method="post">
        <div class="input-field">
          <input id="search" type="search" name="inputcaridatanotifikasi" class="inputcaridatanotifikasi" value="<?=$valuecari;?>" autocomplete="off" placeholder="Nama atau kode booking..">
          <label class="label-icon" for="search"><i class="material-icons batal">close</i></label>
          <button class="material-icons <?= $profil['tema_user']; ?>" type="submit" name="caridatanotifikasi" style="height:100%;border:0;right:0;padding-right:10px;padding-left:10px;color:white;"><i class="material-icons caridatanotifikasi">search</i></button>
        </div>
      </form>
      <?php }else if($title=='daftar pesanan'){ ?>
      <form action="<?=base_url('users/daftarpesanan'); ?>" method="post">
        <div class="input-field">
          <input id="search" type="search" name="inputcaridatadaftarpesanan" class="inputcaridatadaftarpesanan" value="<?=$valuecari;?>" autocomplete="off" placeholder="Kode booking atau nama member..">
          <label class="label-icon" for="search"><i class="material-icons batal">close</i></label>
          <button class="material-icons <?= $profil['tema_user']; ?>" type="submit" name="caridatadaftarpesanan" style="height:100%;border:0;right:0;padding-right:10px;padding-left:10px;color:white;"><i class="material-icons caridatadaftarpesanan">search</i></button>
        </div>
      </form>
      <?php } ?>
        
    </div>
  </nav>
  </div>


  <!-- navbar -->
  <div class="navbar-fixed">
    <nav class="nav-extended <?= $profil['tema_user']; ?> navbar-fixed navmenu">
      <div class="nav-wrapper scrollhide">

        <div class="container">
          <a href="#" class="brand-logo hide-on-small-and-down">Light Creative</a>
          <a href="#" class="brand-logo show-on-small hide-on-med-and-up" style="font-size: 18px">Light Creative</a>
        </div>
        <ul id="nav-mobile" class="">
          <li data-target="slide-out" class="sidenav-trigger"><a href=""><i class="material-icons">menu</i></a></li>
          
            <div class="right">
              
              <li><a href="#"><i class="material-icons show-on-medium cari">search</i></a></li>
            <?php if($title=="beranda"){ ?>
              <span class="hide-on-med-and-down">
              <li><a class="active aktif" href="<?= base_url('users'); ?>"><i class="material-icons left">home</i>Beranda</a></li>
              <li><a href="<?= base_url('users/pemesanan'); ?>"><i class="material-icons left">contact_mail</i>Pemesanan</a></li>
            <?php if($this->session->userdata('level_user')=='user'): ?>
              <li><a href="<?= base_url('users/daftarpesanan'); ?>"><i class="material-icons left">list_alt</i>daftar pesanan</a></li>
            <?php endif; ?>
            <?php if($this->session->userdata('level_user')=='admin'): ?>
              <li><a href="<?= base_url('admin'); ?>"><i class="material-icons left">notifications_active</i>Notifikasi
              <?php if($this->session->userdata('level_user')=='admin'){ ?> 
                <?php if($countnotifikasi['totalcount']>0){ ?> 
                  <span class="new badge btn-floating pulse red z-depth-2" style="border-radius:4px;"><?=$countnotifikasi['totalcount']; ?></span>
                <?php }else{} ?>
              <?php }else{} ?>
              </a></li>
            <?php endif; ?>
              </span>
            <?php }else if($title=="pemesanan"){ ?>
              <span class="hide-on-med-and-down">
              <li><a href="<?= base_url('users'); ?>"><i class="material-icons left">home</i>Beranda</a></li>
              <li><a class="active aktif" href="<?= base_url('users/pemesanan'); ?>"><i class="material-icons left">contact_mail</i>Pemesanan</a></li>
            <?php if($this->session->userdata('level_user')=='user'): ?>
              <li><a href="<?= base_url('users/daftarpesanan'); ?>"><i class="material-icons left">list_alt</i>daftar pesanan</a></li>
            <?php endif; ?>
            <?php if($this->session->userdata('level_user')=='admin'): ?>
              <li><a href="<?= base_url('admin'); ?>"><i class="material-icons left">notifications_active</i>Notifikasi
              <?php if($this->session->userdata('level_user')=='admin'){ ?> 
                <?php if($countnotifikasi['totalcount']>0){ ?> 
                  <span class="new badge btn-floating pulse red z-depth-2" style="border-radius:4px;"><?=$countnotifikasi['totalcount']; ?></span>
                <?php }else{} ?>
              <?php }else{} ?>
              </a></li>
            <?php endif; ?>
              </span>
            <?php }else if($title=="daftar pesanan"){ ?>
              <span class="hide-on-med-and-down">
              <li><a href="<?= base_url('users'); ?>"><i class="material-icons left">home</i>Beranda</a></li>
              <li><a href="<?= base_url('users/pemesanan'); ?>"><i class="material-icons left">contact_mail</i>Pemesanan</a></li>
            <?php if($this->session->userdata('level_user')=='user'): ?>
              <li><a class="active aktif" href="<?= base_url('users/daftarpesanan'); ?>"><i class="material-icons left">list_alt</i>daftar pesanan</a></li>
            <?php endif; ?>
            <?php if($this->session->userdata('level_user')=='admin'): ?>
              <li><a href="<?= base_url('admin'); ?>"><i class="material-icons left">notifications_active</i>Notifikasi 
              <?php if($this->session->userdata('level_user')=='admin'){ ?> 
                <?php if($countnotifikasi['totalcount']>0){ ?> 
                  <span class="new badge btn-floating pulse red z-depth-2" style="border-radius:4px;"><?=$countnotifikasi['totalcount']; ?></span>
                <?php }else{} ?>
              <?php }else{} ?>
              </a></li>
            <?php endif; ?>
              </span>
            <?php }else if($title=="notifikasi"){ ?>

              <span class="hide-on-med-and-down">
              <li><a href="<?= base_url('users'); ?>"><i class="material-icons left">home</i>Beranda</a></li>
              <li><a href="<?= base_url('users/pemesanan'); ?>"><i class="material-icons left">contact_mail</i>Pemesanan</a></li>
            <?php if($this->session->userdata('level_user')=='user'): ?>
              <li><a href="<?= base_url('users/daftarpesanan'); ?>"><i class="material-icons left">list_alt</i>daftar pesanan</a></li>
            <?php endif; ?>
            <?php if($this->session->userdata('level_user')=='admin'): ?>
              <li><a class="active aktif" href="<?= base_url('admin'); ?>"><i class="material-icons left">notifications_active</i>Notifikasi
              <?php if($this->session->userdata('level_user')=='admin'){ ?> 
                <?php if($countnotifikasi['totalcount']>0){ ?> 
                  <span class="new badge btn-floating pulse red z-depth-2 taruhangkaweb" style="border-radius:4px;"><?=$countnotifikasi['totalcount']; ?></span>
                <?php }else{} ?>
              <?php }else{} ?>
              </a></li>
              </span>
            <?php endif; ?>

            <?php } ?>
              <li><a class="dropdown-trigger" href="#" data-target="dropdown1"><i class="material-icons">more_vert</i></a></li>

            </div>
          
        </ul>
      </div>

      <div class="nav-content">
      <?php if($title=='beranda'){ ?>
        <ul class="tabs tabs-transparent hide-on-large-only" style="padding-bottom: 5px;">
          <li class="tab"><a class="active aktif" href="<?= base_url('users'); ?>"><i class="material-icons">home</i></a></li>
          <li class="tab"><a href="<?= base_url('users/pemesanan'); ?>"><i class="material-icons">contact_mail</i></a></li>
        <?php if($this->session->userdata('level_user')=='user'): ?>
          <li class="tab"><a href="<?= base_url('users/daftarpesanan'); ?>"><i class="material-icons">list_alt</i></a></li>
        <?php endif; ?>
        <?php if($this->session->userdata('level_user')=='admin'): ?>
          <li class="tab"><a href="<?= base_url('admin'); ?>"><i class="material-icons">notifications_active</i>
          <?php if($this->session->userdata('level_user')=='admin'){ ?> 
            <?php if($countnotifikasi['totalcount']>0){ ?> 
            <span class="btn-floating pulse red z-depth-2" style="top:-63px;right:-17px;border-radius:4px;width:20px;height:20px;line-height:20px"><?=$countnotifikasi['totalcount']; ?></span>
            <?php }else{} ?>
          <?php }else{} ?>
          </a></li>
        <?php endif; ?>
        </ul>
      <?php }else if($title=='pemesanan'){ ?>
        <ul class="tabs tabs-transparent hide-on-large-only" style="padding-bottom: 5px;">
          <li class="tab"><a href="<?= base_url('users'); ?>"><i class="material-icons">home</i></a></li>
          <li class="tab"><a class="active aktif" href="<?= base_url('users/pemesanan'); ?>"><i class="material-icons">contact_mail</i></a></li>
        <?php if($this->session->userdata('level_user')=='user'): ?>
          <li class="tab"><a href="<?= base_url('users/daftarpesanan'); ?>"><i class="material-icons">list_alt</i></a></li>
        <?php endif; ?>
        <?php if($this->session->userdata('level_user')=='admin'): ?>
          <li class="tab"><a href="<?= base_url('admin'); ?>"><i class="material-icons">notifications_active</i>
          <?php if($this->session->userdata('level_user')=='admin'){ ?> 
            <?php if($countnotifikasi['totalcount']>0){ ?> 
            <span class="btn-floating pulse red z-depth-2" style="top:-63px;right:-17px;border-radius:4px;width:20px;height:20px;line-height:20px"><?=$countnotifikasi['totalcount']; ?></span>
            <?php }else{} ?>
          <?php }else{} ?>
          </a></li>
        <?php endif; ?>
        </ul>
      <?php }else if($title=='daftar pesanan'){ ?>
        <ul class="tabs tabs-transparent hide-on-large-only" style="padding-bottom: 5px;">
          <li class="tab"><a href="<?= base_url('users'); ?>"><i class="material-icons">home</i></a></li>
          <li class="tab"><a href="<?= base_url('users/pemesanan'); ?>"><i class="material-icons">contact_mail</i></a></li>
        <?php if($this->session->userdata('level_user')=='user'): ?>
          <li class="tab"><a class="active aktif" href="<?= base_url('users/daftarpesanan'); ?>"><i class="material-icons">list_alt</i></a></li>
        <?php endif; ?>
        <?php if($this->session->userdata('level_user')=='admin'): ?>
          <li class="tab"><a href="<?= base_url('admin'); ?>"><i class="material-icons">notifications_active</i>
          <?php if($this->session->userdata('level_user')=='admin'){ ?> 
            <?php if($countnotifikasi['totalcount']>0){ ?> 
            <span class="btn-floating pulse red z-depth-2" style="top:-63px;right:-17px;border-radius:4px;width:20px;height:20px;line-height:20px"><?=$countnotifikasi['totalcount']; ?></span>
            <?php }else{} ?>
          <?php }else{} ?>
          </a></li>
        <?php endif; ?>
        </ul>
      <?php }else if($title=='notifikasi'){ ?>
        <ul class="tabs tabs-transparent hide-on-large-only" style="padding-bottom: 5px;">
          <li class="tab"><a href="<?= base_url('users'); ?>"><i class="material-icons">home</i></a></li>
          <li class="tab"><a href="<?= base_url('users/pemesanan'); ?>"><i class="material-icons">contact_mail</i></a></li>
        <?php if($this->session->userdata('level_user')=='user'): ?>
          <li class="tab"><a href="<?= base_url('users/daftarpesanan'); ?>"><i class="material-icons">list_alt</i></a></li>
        <?php endif; ?>
        <?php if($this->session->userdata('level_user')=='admin'): ?>
          <li class="tab"><a class="active aktif" href="<?= base_url('admin'); ?>"><i class="material-icons">notifications_active</i>
          <?php if($this->session->userdata('level_user')=='admin'){ ?> 
            <?php if($countnotifikasi['totalcount']>0){ ?> 
            <span class="btn-floating pulse red z-depth-2 taruhangkamobile" style="top:-63px;right:-17px;border-radius:4px;width:20px;height:20px;line-height:20px"><?=$countnotifikasi['totalcount']; ?></span>
            <?php }else{} ?>
          <?php }else{} ?>
          </a></li>
        <?php endif; ?>
        </ul>
      <?php } ?>
      </div>
    </nav>
  </div>


  <!-- Dropdown Trigger -->
  <!-- <a class='dropdown-trigger btn' href='#' data-target='dropdown1'>Drop Me!</a> -->

  <!-- Dropdown Structure -->
  <ul id='dropdown1' class='dropdown-content'>
    <li><a href="#!" class="center <?= $profil['tema_user']; ?> white-text">Theme</a></li>

<?php if($profil['tema_user']=="teal"){ ?>
    <li class="themeteal">
      <span class="switch">
        <label>
          Off
          <input checked type="checkbox" value="teal" class="valueteal">
          <span class="lever teal"></span>
          On
        </label>
      </span>
    </li>
    <li class="themeblue">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="blue" class="valueblue">
          <span class="lever blue"></span>
          On
        </label>
      </span>
    </li>
    <li class="themegreydark">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="grey darken-4" class="valuegreydark">
          <span class="lever grey darken-4"></span>
          On
        </label>
      </span>
    </li>
    <li class="themered">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="red" class="valuered">
          <span class="lever red"></span>
          On
        </label>
      </span>
    </li>
    <li class="themeorange">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="orange" class="valueorange">
          <span class="lever orange"></span>
          On
        </label>
      </span>
    </li>
  <?php }else if($profil['tema_user']=="blue"){ ?>
    <li class="themeteal">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="teal" class="valueteal">
          <span class="lever teal"></span>
          On
        </label>
      </span>
    </li>
    <li class="themeblue">
      <span class="switch">
        <label>
          Off
          <input checked type="checkbox" value="blue" class="valueblue">
          <span class="lever blue"></span>
          On
        </label>
      </span>
    </li>
    <li class="themegreydark">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="grey darken-4" class="valuegreydark">
          <span class="lever grey darken-4"></span>
          On
        </label>
      </span>
    </li>
    <li class="themered">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="red" class="valuered">
          <span class="lever red"></span>
          On
        </label>
      </span>
    </li>
    <li class="themeorange">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="orange" class="valueorange">
          <span class="lever orange"></span>
          On
        </label>
      </span>
    </li>
  <?php }else if($profil['tema_user']=="grey darken-4"){ ?>
    <li class="themeteal">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="teal" class="valueteal">
          <span class="lever teal"></span>
          On
        </label>
      </span>
    </li>
    <li class="themeblue">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="blue" class="valueblue">
          <span class="lever blue"></span>
          On
        </label>
      </span>
    </li>
    <li class="themegreydark">
      <span class="switch">
        <label>
          Off
          <input checked type="checkbox" value="grey darken-4" class="valuegreydark">
          <span class="lever grey darken-4"></span>
          On
        </label>
      </span>
    </li>
    <li class="themered">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="red" class="valuered">
          <span class="lever red"></span>
          On
        </label>
      </span>
    </li>
    <li class="themeorange">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="orange" class="valueorange">
          <span class="lever orange"></span>
          On
        </label>
      </span>
    </li>
  <?php }else if($profil['tema_user']=="red"){ ?>
    <li class="themeteal">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="teal" class="valueteal">
          <span class="lever teal"></span>
          On
        </label>
      </span>
    </li>
    <li class="themeblue">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="blue" class="valueblue">
          <span class="lever blue"></span>
          On
        </label>
      </span>
    </li>
    <li class="themegreydark">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="grey darken-4" class="valuegreydark">
          <span class="lever grey darken-4"></span>
          On
        </label>
      </span>
    </li>
    <li class="themered">
      <span class="switch">
        <label>
          Off
          <input checked type="checkbox" value="red" class="valuered">
          <span class="lever red"></span>
          On
        </label>
      </span>
    </li>
    <li class="themeorange">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="orange" class="valueorange">
          <span class="lever orange"></span>
          On
        </label>
      </span>
    </li>
  <?php }else if($profil['tema_user']=="orange"){ ?>
    <li class="themeteal">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="teal" class="valueteal">
          <span class="lever teal"></span>
          On
        </label>
      </span>
    </li>
    <li class="themeblue">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="blue" class="valueblue">
          <span class="lever blue"></span>
          On
        </label>
      </span>
    </li>
    <li class="themegreydark">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="grey darken-4" class="valuegreydark">
          <span class="lever grey darken-4"></span>
          On
        </label>
      </span>
    </li>
    <li class="themered">
      <span class="switch">
        <label>
          Off
          <input type="checkbox" value="red" class="valuered">
          <span class="lever red"></span>
          On
        </label>
      </span>
    </li>
    <li class="themeorange">
      <span class="switch">
        <label>
          Off
          <input checked type="checkbox" value="orange" class="valueorange">
          <span class="lever orange"></span>
          On
        </label>
      </span>
    </li>
  <?php } ?>

  </ul>