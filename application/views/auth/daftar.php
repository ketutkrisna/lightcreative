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
      <title>daftar</title>
    </head>

    <body>
      <!-- navbar -->
      <div class="navbar-fixed">
        <nav class="nav-extended teal navbar-fixed">
          <div class="nav-wrapper">
            <div class="container">
            <a href="#" class="brand-logo hide-on-small-and-down center">Light Creative</a>
            <a href="#" class="brand-logo show-on-small hide-on-med-and-up center" style="font-size: 25px">Light Creative</a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
              
            </ul>
            </div>
          </div>
        </nav>
      </div>

      
      <div class="row">
        <div class="col s12 center-align" style="margin-top:20px;">
          <h5>DAFTAR</h5>
        </div> 
      </div>

      <div class="container" style="padding-bottom: 30px">

      <div class="row" style="max-width: 500px">
        <form class="col s12" action="<?= base_url('auth/daftar'); ?>" method="post">
          <div class="row">
            <div class="input-field col s12" style="margin-top: -10px;<?php if(form_error('namadaftar')){echo "margin-bottom:-10px;";} ?>">
              <input id="fullname" type="text" name="namadaftar" class="validate" value="<?= set_value('namadaftar'); ?>" autocomplete="off">
              <label for="fullname">Nama Lengkap</label>
              <?= form_error('namadaftar','<span class="red-text right">', '</span>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12" style="margin-top: -10px;<?php if(form_error('namadaftar')){echo "margin-bottom:-10px;";} ?>">
              <input id="tgllahir" type="text" class="datepicker" name="tgllahirdaftar" value="<?= set_value('tgllahirdaftar'); ?>" autocomplete="off">
              <label for="tgllahir">Tanggal Lahir</label>
              <?= form_error('tgllahirdaftar','<span class="red-text right">', '</span>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12" style="margin-top:-10px;<?php if(form_error('jeniskelamindaftar')){echo "margin-bottom:-10px;";} ?>">
              <select name="jeniskelamindaftar">
                <option value="" disabled selected>Jenis Kelamin</option>
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
              </select>
              <?= form_error('jeniskelamindaftar','<span class="red-text right">','</span>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12" style="margin-top: -10px;<?php if(form_error('emaildaftar')){echo "margin-bottom:-10px;";} ?>">
              <input id="email" type="email" name="emaildaftar" class="validate" value="<?= set_value('emaildaftar'); ?>" autocomplete="off">
              <label for="email">Email</label>
              <?= form_error('emaildaftar','<span class="red-text right">','</span>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6" style="margin-top: -10px">
              <input id="password1" type="password" name="pdaftar1" class="validate">
              <label for="password1">Password</label>
            </div>
            <div class="input-field col s6" style="margin-top: -10px">
              <input id="password2" type="password" name="pdaftar2" class="validate">
              <label for="password2">Confirm password</label>
              <?= form_error('pdaftar1','<span class="red-text right">','</span>'); ?>
            </div>
          </div>
          <div class="center">
            <button class="btn-large waves-effect waves-light blue darken-3" type="submit" name="action" style="width: 100%">DAFTAR
            </button>
          </div>
        </form>
      </div>

      <div class="row">
        <div class="col s12 center-align">
          <span><a href="<?= base_url('auth'); ?>">Login!</a></span>
        </div> 
      </div>

      </div>
      

      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="<?=base_url('assets');?>/js/jquery.js"></script>
      <script type="text/javascript" src="<?=base_url('assets');?>/js/materialize.min.js"></script>

      <script type="text/javascript">
        $(document).ready(function(){

            $('.sidenav').sidenav();
            $('.materialboxed').materialbox();
            $('select').formSelect();
            $('.datepicker').datepicker({
              format:'yyyy-mm-dd'
            });
            $('.goback').on('click',function(){
              parent.history.back();
              return false;
            });

        });
      </script>
    </body>
  </html>