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
              <a href="#" class="brand-logo hide-on-small-and-down center">About</a>
              <a href="#" class="brand-logo show-on-small hide-on-med-and-up center" style="font-size: 18px">About</a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
            </ul>
            </div>
          </div>
        </nav>
      </div>


      <!-- <div class="row">
        <div class="col s12 center-align">
          <h3>Light Creative</h3>
        </div> 
      </div> -->


      <div class="container center-align">
      <div class="row">
        <div class="col s12 m12" style="margin-top: 30px">
          <div class="card-panel">
            <div class="col s12 center-align">
            <img src="<?= base_url('assets/img/lc/').'lc.png'; ?>" width="100">
            </div>
            <h5>Light Creative</h5>
            <span class="black-text">I am a very simple card. I am good at containing small bits of information.
            I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
            I am a very simple card. I am good at containing small bits of information.
            I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
            </span>
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