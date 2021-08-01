
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<ul class="collection judulno naik">
  <?php foreach($viewbookingadmin as $vba): ?>
  <li class="collection-item avatar <?php if($vba['notifikasi_booking']=='dibaca'){echo'';}else{echo'blue lighten-5';} ?>">
    <img src="<?= base_url(); ?>/assets/img/users/<?= $vba['foto_user']; ?>" alt="" class="circle">
    <span class="title"><?= $vba['nama_user'].' booking '.$vba['bidang_member']; ?></span>
    <p><?=date('d M Y, H.i',$vba['tanggal_booking']); ?></p>
    <span class="" style="font-size:16px;">status :</span>
    <?php if($vba['status_booking']=='cancel'){ ?>
    <i class="material-icons circle red tooltipped" data-position="top" data-tooltip="cancel" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">highlight_off</i>
  <?php }else if($vba['status_booking']=='menunggu'){ ?>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="selesai" style="left: 212px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">done_all</i>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="dalam proses" style="left: 184px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">sync</i>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="dikonfirmasi" style="left:157px;height:22px;width:22px;line-height:22px;font-weight:bold;">done</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="menunggu" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">hourglass_empty</i>
  <?php }else if($vba['status_booking']=='dikonfirmasi'){ ?>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="selesai" style="left: 212px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">done_all</i>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="dalam proses" style="left: 184px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">sync</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="dikonfirmasi" style="left:157px;height:22px;width:22px;line-height:22px;font-weight:bold;">done</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="menunggu" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">hourglass_empty</i>
  <?php }else if($vba['status_booking']=='dalam proses'){ ?>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="selesai" style="left: 212px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">done_all</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="dalam proses" style="left: 184px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">sync</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="dikonfirmasi" style="left:157px;height:22px;width:22px;line-height:22px;font-weight:bold;">done</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="menunggu" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">hourglass_empty</i>
  <?php }else{ ?>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="selesai" style="left: 212px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">done_all</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="dalam proses" style="left: 184px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">sync</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="dikonfirmasi" style="left:157px;height:22px;width:22px;line-height:22px;font-weight:bold;">done</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="menunggu" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">hourglass_empty</i>
  <?php } ?>
    <!-- <span class="new badge btn-floating pulse green accent-2" style="top:-20px;right:5px"></span> -->
    <a href="#!" class="secondary-content"><i class="material-icons dropdown-trigger settingnotifikasi" data-target="settingorderan" data-idbooking="<?= $vba['id_booking']; ?>">more_vert</i></a>
  </li>
  <?php endforeach; ?>
</ul>

<!-- Dropdown Structure -->
  <ul id="settingorderan" class="dropdown-content z-depth-3">
    <input type="hidden" name="idviewbooking" class="idviewbooking">
    <li class="confirmasipesanan"><a href="#!" class="datapilihan ds"></a></li>
    <li><a href="#!">hapus</a></li>
  </ul>
