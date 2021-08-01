<div class="minheight row" style="min-height: 555px;">

<div class="row naik slides">
  <div class="col s12 center-align">
    <h5 class="da">Personal Booking</h5>
    <hr style="width:50%;margin-top:5px;margin-bottom:0px;border:2px solid gray;">
  </div> 
</div>

<?php if(count($countc)==0){ ?>
  <h5 class="collection-item center-align" style="padding: 15px;">Data tidak ditemukan!</h5>
<?php }else{ ?>
<ul class="collection naik" style="">
  <?=$this->session->flashdata('message'); ?>
  <?php foreach($members as $member): ?>
    <?php 
      $notifstar=$this->db->get_where('stars',['user_idstar'=>$this->session->userdata('id_user'),'member_idstar'=>$member['id_member']])->result_array();
      $countstar=$this->db->get_where('stars',['member_idstar'=>$member['id_member']])->result_array();
    ?>
  <?php if($member['status_member']=='aktif'){ ?>
  <li class="collection-item avatar">
    <img src="<?= base_url(); ?>assets/img/anggota/<?= $member['foto_member']; ?>" alt="" class="circle aboutanggota modal-trigger" href="#modalaboutanggota" data-idmember="<?= $member['id_member']; ?>">
    <span class="title"><?= ucwords($member['nama_member']); ?> 
    <?php if($member['id_member']==$this->session->flashdata('newnotif')){ ?> <span class="red-text"> new update </span> <?php } ?>
    <?php if($member['id_member']==$this->session->flashdata('newnotiftambah')){ ?> <span class="red-text"> new member </span> <?php } ?>
    </span>
    <p style="color:#757575;"><?='Rp. '.number_format($member['harga_member'], 0, ".", ".").'/Hari'; ?></p>
    <span class="new badge left <?php if($this->session->userdata('level_user')=='user'){echo'modal-trigger '.$profil['tema_user'];}else{echo'grey lighten-1';} ?> booking" href="<?php if($this->session->userdata('level_user')=='user'){echo'#modalbooking';}else{echo'#!';} ?>" data-idmember="<?= $member['id_member']; ?>" data-badge-caption="" style="margin-left: -0">Booking</span>
    <span class="right" style="color:#757575;"><?= ucwords($member['bidang_member']); ?></span>
      <a href="#!" class="secondary-content"><span class="left"><?= count($countstar); ?></span><i class="material-icons star <?php if($notifstar==true){echo'orange-text';}else{echo'grey-text';} ?>" data-star="<?= $member['id_member']; ?>">grade</i></a>
  </li>
  <?php }else{ ?>
    <?php if($this->session->userdata('level_user')=='admin'): ?>
    <li class="collection-item avatar <?php if($this->session->userdata('level_user')=='user'){echo'modal-trigger';}else{echo'';} ?> grey lighten-4 booking grey-text" href="<?php if($this->session->userdata('level_user')=='user'){echo'#modalbooking';}else{echo'#!';} ?>" data-idmember="<?= $member['id_member']; ?>">
      <img src="<?= base_url(); ?>assets/img/anggota/<?= $member['foto_member']; ?>" alt="" class="circle aboutanggota modal-trigger" href="#modalaboutanggota" data-idmember="<?= $member['id_member']; ?>" style="filter: grayscale(1);">
      <span class="title"><?= ucwords($member['nama_member']); ?> 
        <?php if($member['id_member']==$this->session->flashdata('newnotif')){ ?> <span class="red-text"> new update </span> <?php } ?>
        <?php if($member['id_member']==$this->session->flashdata('newnotiftambah')){ ?> <span class="red-text"> new member </span> <?php } ?>
      </span>
      <p style="color:#757575;"><?='Rp '.number_format($member['harga_member'], 0, ".", ".").'/Hari'; ?></p>
      <span class="new badge left <?php if($this->session->userdata('level_user')=='user'){echo'modal-trigger';}else{echo'grey lighten-2';} ?> booking" href="<?php if($this->session->userdata('level_user')=='user'){echo'#modalbooking';}else{echo'#!';} ?>" data-idmember="<?= $member['id_member']; ?>" data-badge-caption="" style="margin-left: -0">Booking</span>

      <span class="right" style="color:#757575;"><?= ucwords($member['bidang_member']); ?></span>
      <a href="#!" class="secondary-content" style="color:<?php if($notifstar==true){echo'#ffcc80';}else{echo'#bdbdbd';} ?>;"><span class="left"><?= count($countstar); ?></span><i class="material-icons star" data-star="<?= $member['id_member']; ?>">grade</i></a>
    </li>
    <?php endif; ?>
  <?php } ?>
  <?php endforeach; ?>
</ul>
<?php } ?>
</div>


<?php if($this->session->userdata('level_user')=='user'): ?>
<!-- Modal pemesanan -->
<div id="modalbooking" class="modal">
  <div class="container" style="font-size: 15px;font-weight: bold;">
    <div class="row kurangi">
      <div class="col s8">
        <p>Pemesanan</p>
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

  <div class="datahide">
  <form action="<?= base_url('users/newbooking'); ?>" method="post">
  <div class="modal-content" style="margin-top: -30px">
    <input type="hidden" name="idmember" class="idmember">
    <input type="hidden" class="hargamember">
    <div class="row">
        <ul class="collection z-depth-2">
          <li class="collection-item avatar green lighten-5 modal-trigger" href="#modalbooking">
            <img class="circle fotobooking left">
            <span class="title namabooking" style="font-weight:400">Sanji</span>
            <p class="detailstarharga grey-text">Videografer</p>
            <span class="bidangbooking grey-text">0</span>
          </li>
        </ul>
    </div>

    <div class="row">
      <div class="input-field col s12" style="margin-top: -10px">
        <div class="col s12"><span class="red-text notifalamat right" style="font-size:11px;font-style:italic;"></span></div>
        <input id="alamat" type="text" name="alamatuser" class="validate alamatuser" autocomplete="on">
        <label for="alamat">Alamat Anda</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12" style="margin-top: -20px">
        <div class="col s12"><span class="red-text notiftlp right" style="font-size:11px;font-style:italic;"></span></div>
        <input id="icon_telephone" type="number" name="teleponuser" class="validate teleponuser" autocomplete="on">
        <label for="icon_telephone">Telephone Anda</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s6" style="margin-top: -20px">
        <input id="tanggalawal" type="text" class="datepicker a tanggalawal" name="tanggalawal" style="font-size: 12px">
      <label for="tanggalawal">Tanggal awal</label>
      </div>
      <div class="input-field col s6" style="margin-top: -20px">
        <input id="tanggalahir" type="text" class="datepicker a tanggalahir" name="tanggalahir" style="font-size: 12px">
        <label for="tanggalahir">Tanggal ahir</label>
      </div>
    </div>
    <div class="row">
      <div class="col s12" style="margin-top:-40px"><span class="red-text notiftgl" style="font-size:11px;font-style:italic;"></span></div>
    </div>

    <input type="hidden" name="totalbooking" class="totalbooking">
    <div class="row">
      <div class="col s12" style="margin-top: -30px;">
        <p>Total : Rp <span class="total"></span></p>
      </div>
    </div>

  </div>
  <div class="modal-footer" style="margin-top: -50px">
    <div class="container">
    <button type="submit" name="newbooking" class="waves-effect waves-green btn-small ok disabled <?= $profil['tema_user']; ?>">Booking</a>
    </div>
  </div>
  </div>
  </form>

</div>
<?php endif; ?>

 <!-- Modal about anggota -->
<div id="modalaboutanggota" class="modal">
  <div class="container" style="font-size: 15px;font-weight: bold;">
    <div class="row kurangia" style="margin-bottom: -0px">
      <div class="col s8">
        <p class="detaildanedit">Profil Anggota</p>
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

  <div class="datahidepemesanan">
  <form action="<?=base_url('admin/editdatamember'); ?>" method="post" enctype="multipart/form-data">
  <div class="modal-content" style="margin-top: -20px">
    <!-- <div class="row"> -->
    <div class="col s12">
      <img class="materialboxed datafoto" width="100%" height="150">
    </div>
    <!-- </div> -->
    <div class="row">

      <span class="hidetext">

      <ul class="collection" style="width:100%;margin-top:0px">
        <li class="collection-item avatar" style="min-height:30px;padding:0px 25px 0px 25px;">
            <!-- <i class="material-icons circle">credit_card</i> -->
            <span class="title datanama" style="font-weight:500;"></span>
            <p class="grey-text">Nama</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:0px 25px 0px 25px;">
            <!-- <i class="material-icons circle">date_range</i> -->
            <span class="title datatanggallahir" style="font-weight:500;"></span>
            <p class="grey-text">Umur</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:0px 25px 0px 25px;">
            <!-- <i class="material-icons circle">exposure</i> -->
            <span class="title datakelamin" style="font-weight:500;"></span>
            <p class="grey-text">Jenis Kelamin</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:0px 25px 0px 25px;">
            <!-- <i class="material-icons circle">phone</i> -->
            <span class="title datanotlp" style="font-weight:500;"></span>
            <p class="grey-text">No. Telp</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:0px 25px 0px 25px;">
            <!-- <i class="material-icons circle">business_center</i> -->
            <span class="title databidang" style="font-weight:500;"></span>
            <p class="grey-text">Bidang/Keahlian</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:0px 25px 0px 25px;">
            <!-- <i class="material-icons circle">attach_money</i> -->
            <span class="title dataharga" style="font-weight:500;"></span>
            <p class="grey-text">Harga</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:0px 25px 0px 25px;">
            <!-- <i class="material-icons circle">star</i> -->
            <span class="title bintang" style="font-weight:500;"></span>
            <p class="grey-text">Star</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:0px 25px 0px 25px;">
            <!-- <i class="material-icons circle">location_on</i> -->
            <span class="title dataalamat" style="font-weight:500;"></span>
            <p class="grey-text">Alamat</p>
        </li>
      <?php if($this->session->userdata('level_user')=='admin'): ?>
        <li class="collection-item avatar" style="min-height:30px;padding:0px 25px 0px 25px;">
            <!-- <i class="material-icons circle">date_range</i> -->
            <span class="title datatgllahir" style="font-weight:500;"></span>
            <p class="grey-text">Tanggal Lahir</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:0px 25px 0px 25px;">
            <!-- <i class="material-icons circle">email</i> -->
            <span class="title dataemail" style="font-weight:500;"></span>
            <p class="grey-text">E-mail</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:0px 25px 0px 25px;">
            <!-- <i class="material-icons circle">swap_horizontal_circle</i> -->
            <span class="title datastatus" style="font-weight:500;"></span>
            <p class="grey-text">Status</p>
        </li>
      <?php endif; ?>
      </ul>

      </span>

      <?php if($this->session->userdata('level_user')=='admin'): ?>
      <span class="hideinput">

        <div class="row" style="">
          <!-- <span class="right" style="font-size:12px;font-style:italic;">jpg,png,gif dibawah 2mb</span> -->
        <div class="file-field input-field col s12">
          <div class="btn <?= $profil['tema_user']; ?>">
            <span>File</span>
            <input type="file" name="fotomemberedit" class="fotomemberedit" multiple>
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate hilangvaluetextmember" type="text" placeholder="Klik untuk pilih file">
          </div>
        </div>
        </div>

        <input type="hidden" name="idmemberlama" class="idmemberlama">
        <div class="row">
          <div class="input-field col s12" style="margin-top: -25px">
            <input id="namamemberedit" class="namamemberedit validate" type="text" name="namamemberedit" autocomplete="off" required>
            <label for="namamemberedit">Nama member</label>
          </div>
        </div>
        
        <div class="row">
          <div class="input-field col s12" style="margin-top: -25px">
            <input id="lahirmemberedits" name="lahirmemberedit" type="text" class="datepicker" required>
            <label for="lahirmemberedits">Tanggal lahir</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12" style="margin-top: -25px">
            <select name="kelaminmemberedit" class="kelaminmemberedit" required>
              <option value="" disabled selected>Jenis kelamin</option>
              <option value="laki-laki">Laki-laki</option>
              <option value="perempuan">Perempuan</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12" style="margin-top: -25px">
            <input id="tlpmemberedit" class="tlpmemberedit validate" type="number" name="tlpmemberedit" autocomplete="off" required>
            <label for="tlpmemberedit">Tlp member</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12" style="margin-top: -25px">
            <select name="bidangmemberedit" class="bidangmemberedit" required>
              <option value="" disabled selected>Keahlian</option>
              <option value="fotografer">Fotografer</option>
              <option value="videografer">Videografer</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12" style="margin-top: -25px">
            <input id="hargamemberedit" class="hargamemberedit validate" type="number" name="hargamemberedit" autocomplete="off" required>
            <label for="hargamemberedit">Harga member</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12" style="margin-top: -25px">
            <input id="alamatmemberedit" class="alamatmemberedit validate" type="text" name="alamatmemberedit" autocomplete="off" required>
            <label for="alamatmemberedit">Alamat member</label>
          </div>
        </div>
        
        <div class="row">
          <div class="input-field col s12" style="margin-top: -25px">
            <input id="emailmemberedit" class="emailmemberedit validate" type="text" name="emailmemberedit" autocomplete="off" required>
            <label for="emailmemberedit">Email member</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12" style="margin-top: -25px">
            <select name="statusmemberedit" class="statusmemberedit" required>
              <option value="" disabled selected>status</option>
              <option value="aktif">Aktif</option>
              <option value="tidak aktif">Tidak aktif</option>
            </select>
          </div>
        </div>

      </span>
      <?php endif; ?>

    </div>
  </div>

  <?php if($this->session->userdata('level_user')=='admin'): ?>
  <div class="modal-footer" style="margin-top: -40px">
    <div class="container">
    <div class="row">
    <a href="#!" class="modal-close waves-effect waves-light btn red left editdeletemember" onclick="return confirm('klik OK untuk hapus!')"><i style="font-size:20px" class="material-icons">delete</i></a>
    <a href="#!" class="waves-effect waves-light btn right editmembershow <?= $profil['tema_user']; ?>"><i style="font-size:20px" class="material-icons">edit</i></a>

    <a class="modal-close waves-effect waves-light btn-small red left editmemberbatal" style="margin-top:-10px">batal</a>
    <button type="submit" name="simpaneditan" class="waves-effect waves-light btn-small right editmembersimpan <?= $profil['tema_user']; ?>" style="margin-top:-10px">simpan</button>
    </div>
    </div>
  </div>
  <?php endif; ?>


  </form>
  </div>

</div>

<?php if($this->session->userdata('level_user')=='admin'): ?>
<!-- button fixed tambah pemesanan -->
<div class="fixed-action-btn">
  <a class="btn-floating btn-large modal-trigger waves-effect waves-light z-depth-3 <?= $profil['tema_user']; ?> modaltambahmember" href="#modaltambahmember">
    <i class="large material-icons">person_add</i>
  </a>
  <ul>
    <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
    <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
    <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
    <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
  </ul>
</div>

<!-- Modal tambah member-->
<div id="modaltambahmember" class="modal">
  <div class="container" style="font-size: 15px;font-weight: bold;">
    <div class="row kurangi" style="padding-bottom: 0">
      <div class="col s8">
        <p>Tambah Member</p>
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
  <form action="<?= base_url('admin/tambahmember'); ?>" method="post" enctype="multipart/form-data">
  <div class="modal-content" style="margin-top: -50px;">

    <div class="row" style="">
      <span class="right" style="font-size:12px;font-style:italic;">jpg,png,gif dibawah 2mb</span>
    <div class="file-field input-field col s12">
      <div class="btn <?= $profil['tema_user']; ?>">
        <span>File</span>
        <input type="file" name="fotomember" class="fotomember" multiple required>
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate hilangvaluetextmember" type="text" placeholder="Klik untuk pilih file" required>
      </div>
    </div>
    </div>

    <div class="row">
      <div class="input-field col s12" style="margin-top: -25px">
        <input id="namamember" class="namamember validate" type="text" name="namamember" autocomplete="off" required>
        <label for="namamember">Nama member</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12" style="margin-top: -25px">
        <input id="alamatmember" class="alamatmember validate" type="text" name="alamatmember" autocomplete="off" required>
        <label for="alamatmember">Alamat member</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12" style="margin-top: -25px">
        <input id="tlpmember" class="tlpmember validate" type="number" name="tlpmember" autocomplete="off" required>
        <label for="tlpmember">Tlp member</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12" style="margin-top: -25px">
        <select name="kelaminmember" class="kelaminmember" required>
          <option value="" disabled selected>Jenis kelamin</option>
          <option value="laki-laki">Laki-laki</option>
          <option value="perempuan">Perempuan</option>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12" style="margin-top: -25px">
        <input id="lahirmember" name="lahirmember" type="text" class="datepicker" required>
        <label for="lahirmember">Tanggal lahir</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12" style="margin-top: -25px">
        <select name="bidangmember" class="bidangmember" required>
          <option value="" disabled selected>Keahlian</option>
          <option value="fotografer">Fotografer</option>
          <option value="videografer">Videografer</option>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12" style="margin-top: -25px">
        <input id="hargamembers" class="hargamembers validate" type="number" name="hargamembers" autocomplete="off" required>
        <label for="hargamembers">Harga member</label>
      </div>
    </div>
    
    <div class="row">
      <div class="input-field col s12" style="margin-top: -25px">
        <input id="emailmember" class="emailmember validate" type="text" name="emailmember" autocomplete="off" required>
        <label for="emailmember">Email member</label>
      </div>
    </div>

  </div>
  <div class="modal-footer" style="margin-top: -35px">
    <div class="container">
    <button style="margin-top:-2px;" type="submit" name="tambahmember" class="waves-effect <?= $profil['tema_user']; ?> waves-light btn-small tambahmember">tambah</a>
    </div>
  </div>
  </div>
  </form>

</div>
<?php endif; ?>

<div class="div" style="height: 40px"></div>

