<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php if(count($daftarbooking)==0){ ?>
    <li class="collection-item center-align" data-idmember=""><h5>Pesanan masih kosong!</h5></li>
  <?php }else{ ?>
  <?php foreach($daftarbooking as $dbooking): ?>
  <li class="collection-item avatar" data-idmember="">
    <img src="<?= base_url(); ?>assets/img/anggota/<?= $dbooking['foto_user']; ?>" alt="" class="circle" data-idmember="">
    <span class="title"><?='Anda melakukan pemesanan '.$dbooking['bidang_member']; ?></span>
    <p><?=date('d M Y, H.i',$dbooking['tanggal_booking']); ?></p>
    <span class="" style="font-size:16px;">status :</span>
  <?php if($dbooking['status_booking']=='cancel'){ ?>
    <i class="material-icons circle red tooltipped" data-position="top" data-tooltip="cancel" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">highlight_off</i>
  <?php }else if($dbooking['status_booking']=='menunggu'){ ?>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="selesai" style="left: 212px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">done_all</i>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="dalam proses" style="left: 184px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">sync</i>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="dikonfirmasi" style="left:157px;height:22px;width:22px;line-height:22px;font-weight:bold;">done</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="menunggu" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">hourglass_empty</i>
  <?php }else if($dbooking['status_booking']=='dikonfirmasi'){ ?>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="selesai" style="left: 212px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">done_all</i>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="dalam proses" style="left: 184px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">sync</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="dikonfirmasi" style="left:157px;height:22px;width:22px;line-height:22px;font-weight:bold;">done</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="menunggu" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">hourglass_empty</i>
  <?php }else if($dbooking['status_booking']=='dalam proses'){ ?>
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
    <a href="#!" class="secondary-content"><i class="material-icons grey-text dropdown-trigger menuaksi" data-target='dropdaftarpesanan' data-detailbooking="<?= $dbooking['id_booking']; ?>">more_vert</i></a>
  </li>
  <?php endforeach; ?>
  <?php } ?>