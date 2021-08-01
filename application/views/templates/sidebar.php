<ul id="slide-out" class="sidenav">
  <li><div class="user-view">
    <div class="background <?= $profil['tema_user']; ?>">
      <!-- <img src="img/5.gif"> -->
    </div>
    <a href="#user"><img class="circle" src="<?= base_url(); ?>assets/img/users/<?= $profil['foto_user']; ?>"></a>
    <a href="#name"><span class="white-text name"><?= ucwords($profil['nama_user']); ?></span></a>
    <a href="#email"><span class="white-text email"><?= $profil['email_user']; ?></span></a>
    <!-- <span class="white-text email" style="margin-top: -15px">Admin</span> -->
  </div></li>
  <li><a href="<?= base_url('users/akun'); ?>"><i class="material-icons">assignment_ind</i>Profil</a></li>
  <li><a href="<?= base_url('users/setpassword'); ?>"><i class="material-icons">settings</i>Setting Password</a></li>
  <li><a href="<?= base_url('auth/logout'); ?>"><i class="material-icons">power_settings_new</i>Keluar</a></li>
  <li><div class="divider"></div></li>
  <li><a href="<?= base_url('users/about'); ?>"><i class="material-icons">info</i>Light Creative</a></li>
</ul>

