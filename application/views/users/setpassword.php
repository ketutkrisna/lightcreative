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
              <a href="#" class="brand-logo hide-on-small-and-down center">Setting Password</a>
              <a href="#" class="brand-logo show-on-small hide-on-med-and-up center" style="font-size: 18px">Setting Password</a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
            </ul>
            </div>
          </div>
        </nav>
      </div>

      <div class="row">
        <div class="col s12" style="margin:100px auto;">
          <div class="card ">
            <div class="card-content">
              <?=$this->session->flashdata('message'); ?>
              <div class="row">
                <form class="col s12" action="<?= base_url('users/setpassword'); ?>" method="post">
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="passwordlama" type="password" class="validate" name="passwordlama" autocomplete="on" required>
                      <label for="passwordlama">Password lama</label>
                      <?= form_error('passwordlama','<span class="red-text right">', '</span>'); ?>
                    </div>
                  </div>
                  <div class="row" style="margin-top:-20px">
                    <div class="input-field col s6">
                      <input id="passwordbaru" type="password" class="validate" name="passwordbaru" autocomplete="on" required>
                      <label for="passwordbaru">Password baru</label>
                    </div>
                    <div class="input-field col s6">
                      <input id="passwordconfirm" type="password" class="validate" name="passwordconfirm" autocomplete="on" required>
                      <label for="passwordconfirm">Confirm password</label>
                      <?= form_error('passwordbaru','<span class="red-text right">', '</span>'); ?>
                    </div>
                  </div>
                  <div class="row" style="margin-top:-10px">
                    <div class="col s12">
                      <button type="submit" name="submit" class="waves-effect waves-light btn-small <?= $profil['tema_user']; ?>">simpan</button>
                    </div>
                  </div>
                </form>
              </div>

            </div>

          </div>
        </div>
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
            // $('.bataleditinfoakun').hide();
            // $('.hideeditinput').hide();
            // $('.editinfoakun').on('click',function(){
            //   $('.infoakunhide').fadeOut();
            //   $('.bataleditinfoakun').fadeIn();
            //   $('.editinfoakun').fadeOut();
            //   $('.hideeditinput').show();
            // });
            // $('.bataleditinfoakun').on('click',function(){
            //   $('.infoakunhide').fadeIn();
            //   $('.bataleditinfoakun').fadeOut();
            //   $('.editinfoakun').fadeIn();
            //   $('.hideeditinput').hide();
            // });

        });
      </script>
    </body>
  </html>