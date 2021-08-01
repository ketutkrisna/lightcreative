 <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?=base_url('assets');?>/css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="<?=base_url('assets');?>/css/mystyle.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title><?= $title; ?></title>
    </head>

    <body>
      <!-- navbar -->
      <div class="navbar-fixed">
        <nav class="nav-extended <?= $profil['tema_user']; ?> navbar-fixed">
          <div class="nav-wrapper">
            <div class="container">
              <span class=""><a href="<?= base_url('users'); ?>"><i class="material-icons left">arrow_back</i></a></span>
              <a href="#" class="brand-logo hide-on-small-and-down center">Informasi Akun</a>
              <a href="#" class="brand-logo show-on-small hide-on-med-and-up center" style="font-size: 18px">Informasi Akun</a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
            </ul>
            </div>
          </div>
        </nav>
      </div>

      
      <!-- <div class="container">
        <div class="row"> -->

          <div class="col s12">
            <img class="materialboxed circle" src="<?= base_url('assets/img/users/'.$profil['foto_user']); ?>" height="200" width="200" style="margin:20px auto;">
          </div>
          <?php 
            $birthDt = new DateTime($profil['tanggallahir_user']);
            $today = new DateTime('today');
            $umur = $today->diff($birthDt)->y;
          ?>

          <ul class="collection infoakunhide" style="margin-bottom:100px">
            <?= $this->session->flashdata('message'); ?>
            <li class="collection-item avatar" style="min-height:63px;padding:10px 25px 0px 85px;">
              <!-- <div class="container"> -->
                <i class="material-icons circle right">credit_card</i>
                <span class="title" style="font-weight:500;"><?=ucwords($profil['nama_user']); ?></span>
                <p class="grey-text">Nama</p>
              <!-- </div> -->
            </li>
            <li class="collection-item avatar" style="min-height:63px;padding:10px 25px 0px 85px;">
              <!-- <div class="container"> -->
                <i class="material-icons circle right">phone</i>
                <span class="title" style="font-weight:500;"><?=$profil['nomertelepon_user']; ?></span>
                <p class="grey-text">No. Telp</p>
              <!-- </div> -->
            </li>
            <li class="collection-item avatar" style="min-height:63px;padding:10px 25px 0px 85px;">
              <!-- <div class="container"> -->
                <i class="material-icons circle right">date_range</i>
                <span class="title" style="font-weight:500;"><?=$umur.' Tahun'; ?></span>
                <p class="grey-text">Umur</p>
              <!-- </div> -->
            </li>
            <li class="collection-item avatar" style="min-height:63px;padding:10px 25px 0px 85px;">
              <!-- <div class="container"> -->
                <i class="material-icons circle right">exposure</i>
                <span class="title" style="font-weight:500;"><?=ucwords($profil['jeniskelamin_user']); ?></span>
                <p class="grey-text">Jenis Kelamin</p>
              <!-- </div> -->
            </li>
            <li class="collection-item avatar" style="min-height:63px;padding:10px 25px 0px 85px;">
              <!-- <div class="container"> -->
                <i class="material-icons circle right">location_on</i>
                <span class="title" style="font-weight:500;"><?=ucwords($profil['alamat_user']); ?></span>
                <p class="grey-text">Alamat</p>
              <!-- </div> -->
            </li>
            <li class="collection-item avatar" style="min-height:63px;padding:10px 25px 0px 85px;">
              <!-- <div class="container"> -->
                <i class="material-icons circle right">email</i>
                <span class="title" style="font-weight:500;"><?=$profil['email_user']; ?></span>
                <p class="grey-text">E-mail</p>
              <!-- </div> -->
            </li>
          </ul>

          <span class="hideeditinput">
          <form action="<?= base_url('users/editakun'); ?>" method="post" enctype="multipart/form-data">
          <div class="container" style="margin-bottom:80px;">
            <div class="row" style="">
            <div class="file-field input-field col s12">
              <div class="btn <?= $profil['tema_user']; ?>">
                <span>File</span>
                <input type="file" name="fotoakun" class="fotoakun" multiple>
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate hilangvaluetextmember" type="text" placeholder="Klik untuk pilih file">
              </div>
            </div>
            </div>

            <input type="hidden" name="idmemberlama" class="idmemberlama">
            <div class="row">
              <div class="input-field col s12" style="margin-top: -25px">
                <i class="material-icons prefix">credit_card</i>
                <input id="namaakun" class="namaakun validate" type="text" name="namaakun" value="<?=$profil['nama_user']; ?>" autocomplete="off" required>
                <label for="namaakun">Nama</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12" style="margin-top: -25px">
                <i class="material-icons prefix">phone</i>
                <input id="tlpakun" class="tlpakun validate" type="number" name="tlpakun" value="<?=$profil['nomertelepon_user']; ?>" autocomplete="off" required>
                <label for="tlpakun">No.telp</label>
              </div>
            </div>
            
            <div class="row">
              <div class="input-field col s12" style="margin-top: -25px">
                <i class="material-icons prefix">date_range</i>
                <input id="lahirakun" class="lahirakun datepicker" name="lahirakun" type="text" value="<?=$profil['tanggallahir_user']; ?>" required>
                <label for="lahirakun">Tanggal lahir</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12" style="margin-top: -25px">
                <i class="material-icons prefix">exposure</i>
                <select name="kelaminakun" class="kelaminakun" required>
                  <?php if($profil['jeniskelamin_user']=='laki-laki'){ ?>
                  <option selected value="laki-laki">Laki-laki</option>
                  <option value="perempuan">Perempuan</option>
                  <?php }else{ ?>
                  <option value="laki-laki">Laki-laki</option>
                  <option selected value="perempuan">Perempuan</option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12" style="margin-top: -25px">
                <i class="material-icons prefix">location_on</i>
                <input id="alamatakun" class="alamatakun validate" type="text" name="alamatakun" value="<?=$profil['alamat_user']; ?>" autocomplete="off" required>
                <label for="alamatakun">Alamat</label>
              </div>
            </div>
            
            <div class="row">
              <div class="input-field col s12" style="margin-top: -25px">
                <i class="material-icons grey-text prefix">email</i>
                <input id="emailakun" class="emailakun validate disabled" type="text" name="emailakun" value="<?=$profil['email_user']; ?>" autocomplete="off" required disabled>
                <label for="emailakun">Email</label>
              </div>
            </div>

            <div class="row">
              <div class="col s12">
                <button type="submit" class="waves-effect waves-light btn-small <?= $profil['tema_user']; ?>" style="margin-top:-20px">simpan</button>
              </div>
            </div>

          </div>
          </form>
          </span>

        <!-- </div>
      </div> -->

      <div class="fixed-action-btn editinfoakun">
        <a class="btn-floating btn-large <?= $profil['tema_user']; ?>">
          <i class="large material-icons">mode_edit</i>
        </a>
      </div>
      <div class="fixed-action-btn bataleditinfoakun">
        <a class="btn-floating btn-large red">
          <i class="large material-icons">close</i>
        </a>
      </div>
      

      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="<?=base_url('assets');?>/js/jquery.js"></script>
      <script type="text/javascript" src="<?=base_url('assets');?>/js/materialize.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){

            // $('.sidenav').sidenav();
            $('.materialboxed').materialbox();
            $('.datepicker').datepicker({
              format:'yyyy-mm-dd'
            });
            $('select').formSelect();
            $('.close').on('click',function(){
              $('.hideflash').fadeOut();
            });
            $('.goback').on('click',function(){
              parent.history.back();
              return false;
            });
            $('.bataleditinfoakun').hide();
            $('.hideeditinput').hide();
            $('.editinfoakun').on('click',function(){
              $('.infoakunhide').fadeOut();
              $('.bataleditinfoakun').fadeIn();
              $('.editinfoakun').fadeOut();
              $('.hideeditinput').show();
            });
            $('.bataleditinfoakun').on('click',function(){
              $('.infoakunhide').fadeIn();
              $('.bataleditinfoakun').fadeOut();
              $('.editinfoakun').fadeIn();
              $('.hideeditinput').hide();
            });

        });
      </script>
    </body>
  </html>