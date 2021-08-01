<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?=base_url('assets');?>/css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="<?=base_url('assets');?>/css/mystyle.css">
      <link rel="stylesheet" type="text/css" href="<?=base_url('assets');?>/css/style.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style type="text/css">
        .grey{
          background-color: #aaa;
        }
      </style>
      <title>login</title>
    </head>

    <body>
      <!-- navbar -->
      <!-- <div class="navbar-fixed">
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

    <div class="container">

      <div class="row">
        <div class="col s12 center-align" style="margin-top:40px;">
          <h5>LOGIN</h5>
        </div> 
      </div>
      <div class="container" style="width:95%;padding-bottom:5px">
      <?= $this->session->flashdata('pesan'); ?>
      </div>
      <div class="row" style="max-width: 500px">
        <form class="col s12" action="<?= base_url('auth'); ?>" method="post">
          <div class="row" style="margin-bottom: -20px">
            <div class="input-field col s12" style="<?php if(form_error('email')){echo "margin-bottom:-5px;";} ?>">
              <i class="material-icons prefix">account_circle</i>
              <input id="icon_prefix" type="email" class="validate" name="email" value="<?= set_value('email'); ?>">
              <label for="icon_prefix">Email</label>
              <div class="row">
                <div class="col s12">
                <?= form_error('email','<span class="red-text right">','</span>'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: -20px">
            <div class="input-field col s12" style="<?php if(form_error('password')){echo "margin-bottom:12px;";} ?>">
              <i class="material-icons prefix">vpn_key</i>
              <input id="icon_telephone" type="password" class="validate" name="password">
              <label for="icon_telephone">Password</label>
              <div class="row">
                <div class="col s12">
                <?= form_error('password','<span class="red-text right">','</span>'); ?>
                </div>
              </div>
            </div>
            <div class="input-field col s12 center" style="<?php if(form_error('password')){echo "margin-top:-5px;";} ?>">
              <button class="btn-large waves-effect waves-light blue darken-3" type="submit" name="login" style="width: 100%">Login
              </button>
            </div>
          </div>
        </form>
      </div>

      <div class="row" style="margin-top: -20px;">
        <div class="col s12 center-align">
          <span><a href="<?= base_url('auth/daftar'); ?>">Buat akun!</a></span>
        </div> 
      </div>

      </div> -->

      <div class="form-structor">
    <!-- <h4 style="text-align: center;color: rgb(0 0 0);">light creative</h4> -->
    <div class="signup">
      <h2 class="form-title" style="" id="signup"><span class="orange-text">Sudah memiliki akun?</span><br>Login</h2>

      <form class="col s12" action="<?= base_url('auth'); ?>" method="post">
        <div class="form-holder">
          <?= $this->session->flashdata('pesan'); ?>
          <input type="email" class="input validate hideinput" placeholder="Email" name="email" value="<?= set_value('email'); ?>" style="height: 30px;margin: 0" />
          <?= form_error('email','<span class="red-text right" style="padding-right:20px;">','</span>'); ?>
          <input type="password" class="input validate hideinput" name="password" placeholder="Password" style="height: 30px;margin: 0" />
          <?= form_error('password','<span class="red-text right" style="padding-right:20px;">','</span>'); ?>
        </div>
        <button class="submit-btn hidebutton">Login</button>
      </form>

    </div>
    <div class="login slide-up">
      <div class="center">
        <h2 class="form-title" id="login"><span>Belum memiliki akun?</span><br> Sign Up
 </h2>
        <!-- <form class="col s12" action="<?= base_url('auth/daftar'); ?>" method="post"> -->
        <div class="form-holder">
          <!-- <div class="row" style="max-width: 500px"> -->
          <form class="col s12" action="<?= base_url('auth/daftar'); ?>" method="post" style="margin-top: 35px">
            <div class="row">
            <div class="input-field col s12" style="margin-top: -20px;<?php if(form_error('namadaftar')){echo "margin-bottom:-10px;";} ?>">
              <input id="fullname" type="text" name="namadaftar" class="validate" value="<?= set_value('namadaftar'); ?>" autocomplete="off">
              <label for="fullname">Nama Lengkap</label>
              <?= form_error('namadaftar','<span class="red-text right">', '</span>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12" style="margin-top: -20px;<?php if(form_error('namadaftar')){echo "margin-bottom:-10px;";} ?>">
              <input id="tgllahir" type="date" class="" name="tgllahirdaftar" value="<?= set_value('tgllahirdaftar'); ?>" autocomplete="off">
              <!-- <label for="tgllahir">Tanggal Lahir</label> -->
              <?= form_error('tgllahirdaftar','<span class="red-text right">', '</span>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12" style="margin-top:-20px;<?php if(form_error('jeniskelamindaftar')){echo "margin-bottom:-10px;";} ?>">
              <select name="jeniskelamindaftar">
                <option value="" disabled selected>Jenis Kelamin</option>
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
              </select>
              <?= form_error('jeniskelamindaftar','<span class="red-text right">','</span>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12" style="margin-top: -20px;<?php if(form_error('emaildaftar')){echo "margin-bottom:-10px;";} ?>">
              <input id="email" type="email" name="emaildaftar" class="validate" value="<?= set_value('emaildaftar'); ?>" autocomplete="off">
              <label for="email">Email</label>
              <?= form_error('emaildaftar','<span class="red-text right">','</span>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6" style="margin-top: -20px">
              <input id="password1" type="password" name="pdaftar1" class="validate">
              <label for="password1">Password</label>
            </div>
            <div class="input-field col s6" style="margin-top: -20px">
              <input id="password2" type="password" name="pdaftar2" class="validate">
              <label for="password2">Confirm password</label>
              <?= form_error('pdaftar1','<span class="red-text right">','</span>'); ?>
            </div>
          </div>

        </div>
        <button class="submit-btn">Sign Up</button>
        </form>
      </div>
    </div>
  </div>
      

      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="<?=base_url('assets');?>/js/jquery.js"></script>
      <script type="text/javascript" src="<?=base_url('assets');?>/js/materialize.min.js"></script>
      <!-- <script type="text/javascript">
        $(document).ready(function(){

            $('.sidenav').sidenav();
            $('.materialboxed').materialbox();
            $('.goback').on('click',function(){
              parent.history.back();
              return false;
            });
            $('.close').on('click',function(){
              $('.hideflash').fadeOut();
            });

        });
      </script> -->
    <script>

      $(document).ready(function(){
          $('.datepicker').datepicker({
            'yearRange':30
          });
          $('select').formSelect();

          $('.close').on('click',function(){
            $('.hideflash').fadeOut();
          });
        });
      // $('.laki').on('click', function(){
      //  $('.ubah').css('color','black');
      // });
      

      console.clear();

      <?php if(isset($_SESSION['auth'])){ ?>
        <?php if($_SESSION['auth']>3){ ?>
      var jam=getTime();
      // console.log(jam.toString().split(""));
      var timephp=<?=$_SESSION['awal']; ?>;
      var timejs=jam.toString().substring(0,jam.toString().length-3);
      // console.log(timephp);
      // console.log(timejs);
      // console.log(timephp-timejs);
      // timephp=timejs;
      intervalid=setInterval(function() {
      timejs++;
      if(timejs>=timephp) {
        $('#waktutunggu').text('Silahkan Login lagi.');
        clearInterval(intervalid);
        $('.hideinput').removeAttr('disabled');
        $('.hidebutton').removeAttr('disabled');
        $('.hidebutton').removeClass('grey');
      }else{
        $('.hideinput').attr('disabled','on');
        $('.hidebutton').attr('disabled','on');
        $('.hidebutton').addClass('grey');
        $('#waktutunggu').html("Anda melewati batas maksimum percobaan login.<br> Harap tunggu "+(timephp-timejs)+" detik lagi.");
      }
      }, 1000);
        <?php } ?>
      <?php } ?>




      const loginBtn = document.getElementById('login');
      const signupBtn = document.getElementById('signup');

      loginBtn.addEventListener('click', e => {
        let parent = e.target.parentNode.parentNode;
        Array.from(e.target.parentNode.parentNode.classList).find(element => {
          if (element !== "slide-up") {
            parent.classList.add('slide-up');
          } else {
            signupBtn.parentNode.classList.add('slide-up');
            parent.classList.remove('slide-up');
          }
        });
      });

      signupBtn.addEventListener('click', e => {
        let parent = e.target.parentNode;
        Array.from(e.target.parentNode.classList).find(element => {
          if (element !== "slide-up") {
            parent.classList.add('slide-up');
          } else {
            loginBtn.parentNode.parentNode.classList.add('slide-up');
            parent.classList.remove('slide-up');
          }
        });
      });
    </script>
    </body>
  </html>