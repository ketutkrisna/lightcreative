<div class="minheight row" style="min-height: 555px;">
<div class="row naik slides">
  <div class="col s12 center-align juduln">
    <h5 class="n">Notifikasi</h5>
    <hr style="width:50%;margin-top:5px;margin-bottom:0px;border:2px solid gray;">
  </div> 
</div>

<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php if(count($menunggu)<1 && count($cancelbelum)<1 && count($konfirmasi)<1 && count($proses)<1 && count($selesai)<1 && count($canceldibaca)<1){ ?>
    <h5 class="center-align" style="padding: 15px;">Tidak ada data!</h5>
<?php }else{ ?>

<!-- <div class="row" style=""> -->
    <!-- <form class="col s12" action="" method="post" style="margin-top: -50px">
      <div class="row">
        <div class="input-field col s5" style="">
          <select>
            <option value="" disabled selected>Sort</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
          </select>
          <button class="waves-effect waves-light btn-small blue prefix" style="margin-top: 0px;height: 36px; right: -50px;font-size: 15px;width: 50px">ok</button>
        </div>
      </div>
    </form> -->
  <!-- </div> -->
  <!-- <div class="row" style="padding:0"> -->
<form action="<?= base_url('admin/index'); ?>" method="post">
  <div class="row">
    <div class="col s5 offset-s5" style="margin-top: -25px;margin-bottom:-25px">
    <div class="input-field naik" style="z-index: 2;">
        
      <?php if($sorting=='DESC'){ ?>
        <select name="sorting">
          <option value="" disabled>Sorting</option>
          <option value="DESC" selected>Terbaru</option>
          <option value="ASC">Terlama</option>
          <option value="TERBANYAK">Terbanyak</option>
        </select>
      <?php }else if($sorting=='ASC'){ ?>
        <select name="sorting">
          <option value="" disabled>Sorting</option>
          <option value="DESC">Terbaru</option>
          <option value="ASC" selected>Terlama</option>
          <option value="TERBANYAK">Terbanyak</option>
        </select>
      <?php }else if($sorting=='TERBANYAK'){ ?>
        <select name="sorting">
          <option value="" disabled>Sorting</option>
          <option value="DESC">Terbaru</option>
          <option value="ASC">Terlama</option>
          <option value="TERBANYAK" selected>Terbanyak</option>
        </select>
      <?php }else{ ?>
        <select name="sorting">
          <option value="" disabled selected>Sorting</option>
          <option value="DESC">Terbaru</option>
          <option value="ASC">Terlama</option>
          <option value="TERBANYAK">Terbanyak</option>
        </select>
      <?php } ?>

      <button class="waves-effect waves-light btn-small blue prefix" name="oksort" style="top: 7px;height: 35px; right: -60px;font-size: 15px;width: 50px;position: absolute;">ok</button>
    </div>
    </div>
  </div>
</form>
  <!-- </div> -->
    

<ul class="collection judulno naik" style="border-bottom:0px;">
  <?=$this->session->flashdata('message'); ?>

  <?php if(count($menunggu)<1){ ?>
    <!-- <h5 class="center-align" style="padding: 15px;">Tidak ada data!</h5> -->
  <?php }else{ ?>
  <li class="collection-header grey lighten-3" style="padding:0px 15px 0px 15px;border-top:1px solid white;height:35px;line-height: 5px;"><p><?=count($menunggu); ?> BOOKING BARU</p></li>
  <?php foreach($viewbookingadmin as $vba): ?>
  <?php if($vba['status_booking']=='menunggu' && $vba['notifikasi_booking']=='belum dibaca'): ?>
  <li class="collection-item avatar <?php if($vba['notifikasi_booking']=='dibaca'){echo'';}else{echo'blue lighten-5';} ?>" data-idbookinguser="<?= $vba['id_booking']; ?>" style="min-height:30px;padding:5px 18px 5px 65px;">
    <img src="<?= base_url(); ?>/assets/img/users/<?= $vba['foto_user']; ?>" alt="" class="circle modal-trigger detailuserbooking" href="#modalaboutuser" data-idbookinguser="<?= $vba['id_booking']; ?>">
    <span class="title"><?= '<b>'.ucwords($vba['nama_user']).'</b> Memesan '.ucwords($vba['bidang_member']); ?> <?=$vba['selisih']+1; ?> Hari</span>
    <p style="color:#757575;"><?=date('d M Y, H.i',$vba['tanggal_booking']); ?> <?php if($vba['kode_booking']==$this->session->flashdata('newnotif')){ ?> <span class="red-text"> New </span> <?php } ?></p>
    <span style="font-size:16px;color:#757575;">Status :</span>
    <?php if($vba['status_booking']=='cancel'){ ?>
    <i class="material-icons circle red tooltipped" data-position="top" data-tooltip="cancel" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">highlight_off</i>
  <?php }else{ ?>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="selesai" style="left: 212px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">done_all</i>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="dalam proses" style="left: 184px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">sync</i>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="dikonfirmasi" style="left:157px;height:22px;width:22px;line-height:22px;font-weight:bold;">done</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="menunggu" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">hourglass_empty</i>
    <?php } ?>

    <br>
    <?php if($vba['notifikasi_pembayaran']=='belum'){ ?>
      <span class="red-text" style="font-size:11px;color:#757575;">Belum melakukan pembayaran! </span><a class="pembayaran"></a>
    <?php }else if($vba['notifikasi_pembayaran']=='ditolak'){ ?>
      <span class="red-text" style="font-size:11px;color:#757575;">Bukti pembayaran anda tolak. </span><a class="pembayaran modal-trigger" href="#modalpembayaranadmin"><span class="lihatmodalpembayaranadmin blue-text"
      data-idbooking="<?= $vba['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
    <?php }else if($vba['notifikasi_pembayaran']=='diupload'){ ?>
      <span class="" style="font-size:11px;color:#757575;">Bukti pembayaran diterima. </span><a class="pembayaran modal-trigger" href="#modalpembayaranadmin"><span class="lihatmodalpembayaranadmin blue-text"
      data-idbooking="<?= $vba['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
    <?php }else{ ?>
      <a style="font-size:11px;color:#757575;" class="pembayaran green-text">Bukti pembayaran diterima.</a>
    <?php } ?>

    <span class="right" style="color:#757575;">
      <?php 
        $tglbooking  = date_create($vba['tanggal_awal']);
        $tglsekarang = date_create();
        $selisih  = date_diff($tglbooking, $tglsekarang);

        $date1 = new DateTime($vba['tanggal_awal']);
        $date3 = new DateTime($vba['tanggal_ahir']);
        $date2 = new DateTime(date('Y-m-d'));
        if($vba['status_booking']=='cancel'){ ?>
          <span>Cancel</span>
       <?php }else{
          if($date2<$date1){
            if($selisih->d+1==1){ ?>
             <span>Besok</span>
          <?php }else{ ?>
              <span><?="H-".($selisih->d+1); ?></span>
           <?php } ?>
         <?php }else if($date2>=$date1 && $date2<=$date3){ ?>
            <span><?="Hari ".($selisih->days +1); ?></span>
          <?php }else if($date2>$date3){ ?>
            <span>Selesai</span>
         <?php }
        }
      ?>
    </span>
    <a href="#!" class="secondary-content"><i class="material-icons dropdown-trigger settingnotifikasi" data-target="settingorderan" data-idbooking="<?= $vba['id_booking']; ?>">more_vert</i></a>
  </li>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php } ?>


  <?php if(count($cancelbelum)<1){ ?>
    <!-- <h5 class="center-align" style="padding: 15px;">Tidak ada data!</h5> -->
  <?php }else{ ?>
  <li class="collection-header grey lighten-3 showcancel" style="padding:0px 15px 0px 15px;border-top:1px solid white;height:35px;line-height: 5px"><p><?= count($cancelbelum); ?> CANCEL BARU</p></li>
  <span class="hidecancel">
  <?php foreach($viewbookingadmin as $vba): ?>
  <?php if($vba['status_booking']=='cancel' && $vba['notifikasi_booking']=='belum dibaca'): ?>
  <li class="collection-item avatar <?php if($vba['notifikasi_booking']=='dibaca'){echo'';}else{echo'blue lighten-5';} ?>" data-idbookinguser="<?= $vba['id_booking']; ?>" style="min-height:30px;padding:5px 18px 5px 65px;">
    <img src="<?= base_url(); ?>/assets/img/users/<?= $vba['foto_user']; ?>" alt="" class="circle modal-trigger detailuserbooking" href="#modalaboutuser" data-idbookinguser="<?= $vba['id_booking']; ?>">
    <span class="title"><?= '<b>'.ucwords($vba['nama_user']).'</b> Cancel Pemesanan '.ucwords($vba['bidang_member']); ?> <?=$vba['selisih']+1; ?> Hari</span>
    <p style="color:#757575;"><?=date('d M Y, H.i',$vba['tanggal_booking']); ?> <?php if($vba['kode_booking']==$this->session->flashdata('newnotif')){ ?> <span class="red-text"> New </span> <?php } ?></p>
    <span class="" style="font-size:16px;color:#757575;">Status :</span>
    <i class="material-icons circle red tooltipped" data-position="top" data-tooltip="cancel" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">highlight_off</i>

    <br>
    <?php if($vba['notifikasi_pembayaran']=='belum'){ ?>
      <span class="red-text" style="font-size:11px;color:#757575;">Belum melakukan pembayaran! </span><a class="pembayaran"></a>
    <?php }else if($vba['notifikasi_pembayaran']=='ditolak'){ ?>
      <span class="red-text" style="font-size:11px;color:#757575;">Bukti pembayaran anda tolak. </span><a class="pembayaran modal-trigger" href="#modalpembayaranadmin"><span class="lihatmodalpembayaranadmin blue-text"
      data-idbooking="<?= $vba['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
    <?php }else if($vba['notifikasi_pembayaran']=='diupload'){ ?>
      <span class="" style="font-size:11px;color:#757575;">Bukti pembayaran diterima. </span><a class="pembayaran modal-trigger" href="#modalpembayaranadmin"><span class="lihatmodalpembayaranadmin blue-text"
      data-idbooking="<?= $vba['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
    <?php }else{ ?>
      <a style="font-size:11px;color:#757575;" class="pembayaran green-text">Bukti pembayaran diterima.</a>
    <?php } ?>

    <span class="right" style="color:#757575;">
      <?php 
        $tglbooking  = date_create($vba['tanggal_awal']);
        $tglsekarang = date_create();
        $selisih  = date_diff($tglbooking, $tglsekarang);

        $date1 = new DateTime($vba['tanggal_awal']);
        $date3 = new DateTime($vba['tanggal_ahir']);
        $date2 = new DateTime(date('Y-m-d'));
        if($vba['status_booking']=='cancel'){ ?>
          <span>Cancel</span>
       <?php }else{
          if($date2<$date1){
            if($selisih->d+1==1){ ?>
             <span>Besok</span>
          <?php }else{ ?>
              <span><?="H-".($selisih->d+1); ?></span>
           <?php } ?>
         <?php }else if($date2>=$date1 && $date2<=$date3){ ?>
            <span><?="Hari ".($selisih->days +1); ?></span>
          <?php }else if($date2>$date3){ ?>
            <span>Selesai</span>
         <?php }
        }
      ?>
    </span>
    <a href="#!" class="secondary-content"><i class="material-icons dropdown-trigger settingnotifikasi" data-target="settingorderan" data-idbooking="<?= $vba['id_booking']; ?>">more_vert</i></a>
  </li>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php } ?>

  </span>


  <?php if(count($konfirmasi)<1){ ?>
    <!-- <h5 class="center-align" style="padding: 15px;">Tidak ada data!</h5> -->
  <?php }else{ ?>
  <li class="collection-header grey lighten-3 showkonfirmasi" style="padding:0px 15px 0px 15px;border-top:1px solid white;height:35px;line-height: 5px"><p><?= count($konfirmasi); ?>  DI KONFIRMASI</p></li>
  <span class="hidekonfirmasi">
  <?php foreach($viewbookingadmin as $vba): ?>
  <?php if($vba['status_booking']=='dikonfirmasi'): ?>
  <li class="collection-item avatar <?php if($vba['notifikasi_booking']=='dibaca'){echo'';}else{echo'blue lighten-5';} ?>" data-idbookinguser="<?= $vba['id_booking']; ?>" style="min-height:30px;padding:5px 18px 5px 65px;">
    <img src="<?= base_url(); ?>/assets/img/users/<?= $vba['foto_user']; ?>" alt="" class="circle modal-trigger detailuserbooking" href="#modalaboutuser" data-idbookinguser="<?= $vba['id_booking']; ?>">
    <span class="title"><?= '<b>'.ucwords($vba['nama_user']).'</b> Memesan '.ucwords($vba['bidang_member']); ?> <?=$vba['selisih']+1; ?> Hari</span>
    <p style="color:#757575;"><?=date('d M Y, H.i',$vba['tanggal_booking']); ?> <?php if($vba['kode_booking']==$this->session->flashdata('newnotif')){ ?> <span class="red-text"> New </span> <?php } ?></p>
    <span class="" style="font-size:16px;color:#757575;">Status :</span>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="selesai" style="left: 212px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">done_all</i>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="dalam proses" style="left: 184px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">sync</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="dikonfirmasi" style="left:157px;height:22px;width:22px;line-height:22px;font-weight:bold;">done</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="menunggu" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">hourglass_empty</i>

    <br>
    <?php if($vba['notifikasi_pembayaran']=='belum'){ ?>
      <span class="red-text" style="font-size:11px;color:#757575;">Belum melakukan pembayaran! </span><a class="pembayaran"></a>
    <?php }else if($vba['notifikasi_pembayaran']=='ditolak'){ ?>
      <span class="red-text" style="font-size:11px;color:#757575;">Bukti pembayaran anda tolak. </span><a class="pembayaran modal-trigger" href="#modalpembayaranadmin"><span class="lihatmodalpembayaranadmin blue-text"
      data-idbooking="<?= $vba['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
    <?php }else if($vba['notifikasi_pembayaran']=='diupload'){ ?>
      <span class="" style="font-size:11px;color:#757575;">Bukti pembayaran diterima. </span><a class="pembayaran modal-trigger" href="#modalpembayaranadmin"><span class="lihatmodalpembayaranadmin blue-text"
      data-idbooking="<?= $vba['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
    <?php }else{ ?>
      <a style="font-size:11px;color:#757575;" class="pembayaran green-text">Bukti pembayaran diterima.</a>
    <?php } ?>

    <span class="right" style="color:#757575;">
      <?php 
        $tglbooking  = date_create($vba['tanggal_awal']);
        $tglsekarang = date_create();
        $selisih  = date_diff($tglbooking, $tglsekarang);

        $date1 = new DateTime($vba['tanggal_awal']);
        $date3 = new DateTime($vba['tanggal_ahir']);
        $date2 = new DateTime(date('Y-m-d'));
        if($vba['status_booking']=='cancel'){ ?>
          <span>Cancel</span>
       <?php }else{
          if($date2<$date1){
            if($selisih->d+1==1){ ?>
             <span>Besok</span>
          <?php }else{ ?>
              <span><?="H-".($selisih->d+1); ?></span>
           <?php } ?>
         <?php }else if($date2>=$date1 && $date2<=$date3){ ?>
            <span><?="Hari ".($selisih->days +1); ?></span>
          <?php }else if($date2>$date3){ ?>
            <span>Selesai</span>
         <?php }
        }
      ?>
    </span>
    <a href="#!" class="secondary-content"><i class="material-icons dropdown-trigger settingnotifikasi" data-target="settingorderan" data-idbooking="<?= $vba['id_booking']; ?>">more_vert</i></a>
  </li>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php } ?>
  </span>


  <?php if(count($proses)<1){ ?>
    <!-- <h5 class="center-align" style="padding: 15px;">Tidak ada data!</h5> -->
  <?php }else{ ?>
  <?php $countproses=$this->db->get_where('bookings',['status_booking'=>'dalam proses'])->result_array(); ?>
  <li class="collection-header grey lighten-3 showproses" style="padding:0px 15px 0px 15px;border-top:1px solid white;height:35px;line-height: 5px"><p><?= count($proses); ?> DALAM PROSES</p></li>
  <span class="hideproses">
  <?php foreach($viewbookingadmin as $vba): ?>
  <?php if($vba['status_booking']=='dalam proses'): ?>
  <li class="collection-item avatar <?php if($vba['notifikasi_booking']=='dibaca'){echo'';}else{echo'blue lighten-5';} ?>" data-idbookinguser="<?= $vba['id_booking']; ?>" style="min-height:30px;padding:5px 18px 5px 65px;">
    <img src="<?= base_url(); ?>/assets/img/users/<?= $vba['foto_user']; ?>" alt="" class="circle modal-trigger detailuserbooking" href="#modalaboutuser" data-idbookinguser="<?= $vba['id_booking']; ?>">
    <span class="title"><?= '<b>'.ucwords($vba['nama_user']).'</b> Memesan '.ucwords($vba['bidang_member']); ?> <?=$vba['selisih']+1; ?> Hari</span>
    <p style="color:#757575;"><?=date('d M Y, H.i',$vba['tanggal_booking']); ?> <?php if($vba['kode_booking']==$this->session->flashdata('newnotif')){ ?> <span class="red-text"> New </span> <?php } ?></p>
    <span class="" style="font-size:16px;color:#757575;">Status :</span>
    <i class="material-icons circle tooltipped" data-position="top" data-tooltip="selesai" style="left: 212px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">done_all</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="dalam proses" style="left: 184px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">sync</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="dikonfirmasi" style="left:157px;height:22px;width:22px;line-height:22px;font-weight:bold;">done</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="menunggu" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">hourglass_empty</i>

    <br>
    <?php if($vba['notifikasi_pembayaran']=='belum'){ ?>
      <span class="red-text" style="font-size:11px;color:#757575;">Belum melakukan pembayaran! </span><a class="pembayaran"></a>
    <?php }else if($vba['notifikasi_pembayaran']=='ditolak'){ ?>
      <span class="red-text" style="font-size:11px;color:#757575;">Bukti pembayaran anda tolak. </span><a class="pembayaran modal-trigger" href="#modalpembayaranadmin"><span class="lihatmodalpembayaranadmin blue-text"
      data-idbooking="<?= $vba['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
    <?php }else if($vba['notifikasi_pembayaran']=='diupload'){ ?>
      <span class="" style="font-size:11px;color:#757575;">Bukti pembayaran diterima. </span><a class="pembayaran modal-trigger" href="#modalpembayaranadmin"><span class="lihatmodalpembayaranadmin blue-text"
      data-idbooking="<?= $vba['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
    <?php }else{ ?>
      <a style="font-size:11px;color:#757575;" class="pembayaran green-text">Bukti pembayaran diterima.</a>
    <?php } ?>

    <span class="right" style="color:#757575;">
      <?php 
        $tglbooking  = date_create($vba['tanggal_awal']);
        $tglsekarang = date_create();
        $selisih  = date_diff($tglbooking, $tglsekarang);

        $date1 = new DateTime($vba['tanggal_awal']);
        $date3 = new DateTime($vba['tanggal_ahir']);
        $date2 = new DateTime(date('Y-m-d'));
        if($vba['status_booking']=='cancel'){ ?>
          <span>Cancel</span>
       <?php }else{
          if($date2<$date1){
            if($selisih->d+1==1){ ?>
             <span>Besok</span>
          <?php }else{ ?>
              <span><?="H-".($selisih->d+1); ?></span>
           <?php } ?>
         <?php }else if($date2>=$date1 && $date2<=$date3){ ?>
            <span><?="Hari ".($selisih->days +1); ?></span>
          <?php }else if($date2>$date3){ ?>
            <span>Selesai</span>
         <?php }
        }
      ?>
    </span>
    <a href="#!" class="secondary-content"><i class="material-icons dropdown-trigger settingnotifikasi" data-target="settingorderan" data-idbooking="<?= $vba['id_booking']; ?>">more_vert</i></a>
  </li>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php } ?>
  </span>


  <?php if(count($selesai)<1){ ?>
    <!-- <h5 class="center-align" style="padding: 15px;">Tidak ada data!</h5> -->
  <?php }else{ ?>
  <li class="collection-header grey lighten-3 showselesai" style="padding:0px 15px 0px 15px;border-top:1px solid white;height:35px;line-height: 5px"><p><?= count($selesai); ?> SELESAI</p></li>
  <span class="hideselesai">
  <?php foreach($viewbookingadmin as $vba): ?>
  <?php if($vba['status_booking']=='selesai'): ?>
  <li class="collection-item avatar <?php if($vba['notifikasi_booking']=='dibaca'){echo'';}else{echo'blue lighten-5';} ?>" data-idbookinguser="<?= $vba['id_booking']; ?>" style="min-height:30px;padding:5px 18px 5px 65px;">
    <img src="<?= base_url(); ?>/assets/img/users/<?= $vba['foto_user']; ?>" alt="" class="circle modal-trigger detailuserbooking" href="#modalaboutuser" data-idbookinguser="<?= $vba['id_booking']; ?>">
    <span class="title"><?= '<b>'.ucwords($vba['nama_user']).'</b> Memesan '.ucwords($vba['bidang_member']); ?> <?=$vba['selisih']+1; ?> Hari</span>
    <p style="color:#757575;"><?=date('d M Y, H.i',$vba['tanggal_booking']); ?> <?php if($vba['kode_booking']==$this->session->flashdata('newnotif')){ ?> <span class="red-text"> New </span> <?php } ?></p>
    <span class="" style="font-size:16px;color:#757575;">Status :</span>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="selesai" style="left: 212px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">done_all</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="dalam proses" style="left: 184px;height: 22px;width: 22px;line-height: 22px;font-weight:bold;">sync</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="dikonfirmasi" style="left:157px;height:22px;width:22px;line-height:22px;font-weight:bold;">done</i>
    <i class="material-icons circle green accent-3 tooltipped" data-position="top" data-tooltip="menunggu" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">hourglass_empty</i>

    <br>
    <?php if($vba['notifikasi_pembayaran']=='belum'){ ?>
      <span class="red-text" style="font-size:11px;color:#757575;">Belum melakukan pembayaran! </span><a class="pembayaran"></a>
    <?php }else if($vba['notifikasi_pembayaran']=='ditolak'){ ?>
      <span class="red-text" style="font-size:11px;color:#757575;">Bukti pembayaran anda tolak. </span><a class="pembayaran modal-trigger" href="#modalpembayaranadmin"><span class="lihatmodalpembayaranadmin blue-text"
      data-idbooking="<?= $vba['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
    <?php }else if($vba['notifikasi_pembayaran']=='diupload'){ ?>
      <span class="" style="font-size:11px;color:#757575;">Bukti pembayaran diterima. </span><a class="pembayaran modal-trigger" href="#modalpembayaranadmin"><span class="lihatmodalpembayaranadmin blue-text"
      data-idbooking="<?= $vba['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
    <?php }else{ ?>
      <a style="font-size:11px;color:#757575;" class="pembayaran green-text">Bukti pembayaran diterima.</a>
    <?php } ?>

    <span class="right" style="color:#757575;">
      <?php 
        $tglbooking  = date_create($vba['tanggal_awal']);
        $tglsekarang = date_create();
        $selisih  = date_diff($tglbooking, $tglsekarang);

        $date1 = new DateTime($vba['tanggal_awal']);
        $date3 = new DateTime($vba['tanggal_ahir']);
        $date2 = new DateTime(date('Y-m-d'));
        if($vba['status_booking']=='cancel'){ ?>
            <span>Cancel</span>
         <?php }else{
            if($date2<$date1){
              if($selisih->d+1==1){ ?>
               <span>Besok</span>
            <?php }else{ ?>
                <span><?="H-".($selisih->d+1); ?></span>
             <?php } ?>
           <?php }else if($date2>=$date1 && $date2<=$date3){ ?>
              <span><?="Hari ".($selisih->days +1); ?></span>
            <?php }else if($date2>$date3){ ?>
              <span>Selesai</span>
           <?php }
          }
        ?>
    </span>
    <a href="#!" class="secondary-content"><i class="material-icons dropdown-trigger settingnotifikasi" data-target="settingorderan" data-idbooking="<?= $vba['id_booking']; ?>">more_vert</i></a>
  </li>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php } ?>

  </span>


  <?php if(count($canceldibaca)<1){ ?>
    <!-- <h5 class="center-align" style="padding: 15px;">Tidak ada data!</h5> -->
  <?php }else{ ?>
  <li class="collection-header grey lighten-3 showcancel" style="padding:0px 15px 0px 15px;border-top:1px solid white;height:35px;line-height: 5px"><p><?= count($canceldibaca); ?> CANCEL</p></li>
  <span class="hidecancel">
  <?php foreach($viewbookingadmin as $vba): ?>
  <?php if($vba['status_booking']=='cancel' && $vba['notifikasi_booking']=='dibaca'): ?>
  <li class="collection-item avatar <?php if($vba['notifikasi_booking']=='dibaca'){echo'';}else{echo'blue lighten-5';} ?>" data-idbookinguser="<?= $vba['id_booking']; ?>" style="min-height:30px;padding:5px 18px 5px 65px;">
    <img src="<?= base_url(); ?>/assets/img/users/<?= $vba['foto_user']; ?>" alt="" class="circle modal-trigger detailuserbooking" href="#modalaboutuser" data-idbookinguser="<?= $vba['id_booking']; ?>">
    <span class="title"><?= '<b>'.ucwords($vba['nama_user']).'</b> Cancel Pemesanan '.ucwords($vba['bidang_member']); ?> <?=$vba['selisih']+1; ?> Hari</span>
    <p style="color:#757575;"><?=date('d M Y, H.i',$vba['tanggal_booking']); ?> <?php if($vba['kode_booking']==$this->session->flashdata('newnotif')){ ?> <span class="red-text"> New </span> <?php } ?></p>
    <span class="" style="font-size:16px;color:#757575;">Status :</span>
    <i class="material-icons circle red tooltipped" data-position="top" data-tooltip="cancel" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">highlight_off</i>

    <br>
    <?php if($vba['notifikasi_pembayaran']=='belum'){ ?>
      <span class="red-text" style="font-size:11px;color:#757575;">Belum melakukan pembayaran! </span><a class="pembayaran"></a>
    <?php }else if($vba['notifikasi_pembayaran']=='ditolak'){ ?>
      <span class="red-text" style="font-size:11px;color:#757575;">Bukti pembayaran anda tolak. </span><a class="pembayaran modal-trigger" href="#modalpembayaranadmin"><span class="lihatmodalpembayaranadmin blue-text"
      data-idbooking="<?= $vba['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
    <?php }else if($vba['notifikasi_pembayaran']=='diupload'){ ?>
      <span class="" style="font-size:11px;color:#757575;">Bukti pembayaran diterima. </span><a class="pembayaran modal-trigger" href="#modalpembayaranadmin"><span class="lihatmodalpembayaranadmin blue-text"
      data-idbooking="<?= $vba['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
    <?php }else{ ?>
      <a style="font-size:11px;color:#757575;" class="pembayaran green-text">Bukti pembayaran diterima.</a>
    <?php } ?>

    <span class="right" style="color:#757575;">
      <?php 
        $tglbooking  = date_create($vba['tanggal_awal']);
        $tglsekarang = date_create();
        $selisih  = date_diff($tglbooking, $tglsekarang);

        $date1 = new DateTime($vba['tanggal_awal']);
        $date3 = new DateTime($vba['tanggal_ahir']);
        $date2 = new DateTime(date('Y-m-d'));
        if($vba['status_booking']=='cancel'){ ?>
            <span>Cancel</span>
         <?php }else{
            if($date2<$date1){
              if($selisih->d+1==1){ ?>
               <span>Besok</span>
            <?php }else{ ?>
                <span><?="H-".($selisih->d+1); ?></span>
             <?php } ?>
           <?php }else if($date2>=$date1 && $date2<=$date3){ ?>
              <span><?="Hari ".($selisih->days +1); ?></span>
            <?php }else if($date2>$date3){ ?>
              <span>Selesai</span>
           <?php }
          }
        ?>
    </span>
    <a href="#!" class="secondary-content"><i class="material-icons dropdown-trigger settingnotifikasi" data-target="settingorderan" data-idbooking="<?= $vba['id_booking']; ?>">more_vert</i></a>
  </li>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php } ?>

  </span>

  <?php if(count($ditolak)<1){ ?>
    <!-- <h5 class="center-align" style="padding: 15px;">Tidak ada data!</h5> -->
  <?php }else{ ?>
  <li class="collection-header grey lighten-3 showcancel" style="padding:0px 15px 0px 15px;border-top:1px solid white;height:35px;line-height: 5px"><p><?= count($ditolak); ?> DI TOLAK</p></li>
  <span class="hideditolak">
  <?php foreach($viewbookingadmin as $vba): ?>
  <?php if($vba['status_booking']=='ditolak' && $vba['notifikasi_booking']=='dibaca'): ?>
  <li class="collection-item avatar <?php if($vba['notifikasi_booking']=='dibaca'){echo'';}else{echo'blue lighten-5';} ?>" data-idbookinguser="<?= $vba['id_booking']; ?>" style="min-height:30px;padding:5px 18px 5px 65px;">
    <img src="<?= base_url(); ?>/assets/img/users/<?= $vba['foto_user']; ?>" alt="" class="circle modal-trigger detailuserbooking" href="#modalaboutuser" data-idbookinguser="<?= $vba['id_booking']; ?>">
    <span class="title"><?= '<b>'.ucwords($vba['nama_user']).'</b> Cancel Pemesanan '.ucwords($vba['bidang_member']); ?> <?=$vba['selisih']+1; ?> Hari</span>
    <p style="color:#757575;"><?=date('d M Y, H.i',$vba['tanggal_booking']); ?> <?php if($vba['kode_booking']==$this->session->flashdata('newnotif')){ ?> <span class="red-text"> New </span> <?php } ?></p>
    <span class="" style="font-size:16px;color:#757575;">Status :</span>
    <i class="material-icons circle red tooltipped" data-position="top" data-tooltip="cancel" style="left:130px;height:22px;width:22px;line-height:22px;font-weight:bold;">highlight_off</i>

    <br>
    <?php if($vba['status_booking']=='ditolak'){ ?>
      <span class="red-text" style="font-size:11px;color:#757575;">Booking telah anda ditolak! </span><a class="pembayaran"></a>
    <?php } ?>

    <span class="right" style="color:#757575;">Ditolak</span>

    <a href="#!" class="secondary-content"><i class="material-icons dropdown-trigger settingnotifikasi" data-target="settingorderan" data-idbooking="<?= $vba['id_booking']; ?>">more_vert</i></a>
  </li>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php } ?>

  </span>

  <li class="collection" style="height:40px;border-bottom:0;border-left:0;border-right:0;"></li>
</ul>

<?php } ?>
</div>


  <!-- Dropdown Structure -->
  <ul id="settingorderan" class="dropdown-content z-depth-3">
    <input type="hidden" name="idviewbooking" class="idviewbooking">
    <li><a class="modal-trigger" href="#modaldetailpesananuser">Detail</a></li>
    <li class="confirmasipesanan"><a href="#!" onclick="return confirm('klik OK untuk melanjutkan')" class="datapilihanok"></a></li>
    <span class="tambahbatal"><li><a onclick="return confirm('klik OK untuk melanjutkan')" class="tolakpesanan">Tolak</a></li></span>
  </ul>

  <!-- Modal uploaduser -->
  <div id="modalpembayaranadmin" class="modal overflowpembayaran" style="margin-bottom: -5px">
    <div class="modal-content">
      <div class="col s8">
        <h5 style="margin-top: -3px;">Bukti Pembayaran</h5>
      </div>
      <div class="col s4">
        <div class="preloader-wrapper small active loader right" style="height: 25px;width: 25px;top:-30px">
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

      <div class="col s4 m7 hidebuktiadmin" style="margin-top: 20px;">
        <div class="card">
          <div class="card-image">
            <img class="materialboxed buktipembayarandiadmin" width="100">
            <!-- <span class="card-title">Card Title</span> -->
          </div>
        </div>
        
      </div>

    </div>
    <div class="modal-footer hidebuktiadmin">
      <div class="row">
          <div class="col s12 center"> 
            <form action="<?=base_url('admin/tolakbuktipembayaran'); ?>" method="post" style="display: inline;">
              <input type="hidden" name="idtolakadmin" class="idterimaadmin">
              <button type="submit" class="waves-effect red waves-light btn-small">Tolak</button>
            </form>
            <form action="<?=base_url('admin/terimabuktipembayaran'); ?>" method="post" style="display: inline;">
              <input type="hidden" name="idterimaadmin" class="idterimaadmin">
              <button type="submit" class="waves-effect waves-light btn-small">Terima</button>
            </form>
          </div>
        </div>
    </div>

  </div>

<!-- Modal detail pesanan -->
<div id="modaldetailpesananuser" class="modal">
  <div class="container" style="font-size: 15px;font-weight: bold;">
    <div class="row kurangi" style="margin-bottom: -0px">
      <div class="col s8">
        <p>Detail Pesanan User</p>
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
  <div class="modal-content" style="margin-top: -20px">

    <!-- <div class="row"> -->
        <ul class="collection">
          <li class="collection-item avatar green lighten-5">
            <img class="circle fotodetailadmin">
            <span class="title namadetailadmin"></span>
            <p class="sukaadminharga grey-text"></p>
            <span class="bidangdetailadmin grey-text"></span>
          </li>
        </ul>
    <!-- </div> -->

      <ul class="collection" style="width:100%;padding: 0;margin-top:-15px">
        <li class="collection-item avatar" style="min-height:30px;padding:2px 15px 2px 15px;">
            <span class="title kodedetailbooking" style="font-weight:500;"></span>
            <p class="grey-text">Kode Booking</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 15px 2px 15px;">
          <!-- <div class="row"> -->
            <div class="col s6 left-align" style="position: absolute;">
            <span class="title tgldetailmulai" style="font-weight:500;"></span>
            <p class="grey-text">Mulai</p>
            </div>
            <div class="col s6 right-align">
            <span class="title tgldetailselesai" style="font-weight:500;"></span>
            <p class="grey-text">Selesai</p>
            </div>
          <!-- </div> -->
        </li>
        <!-- <li class="collection-item avatar" style="min-height:30px;padding:2px 30px 2px 30px;">
            <span class="title tgldetailselesai" style="font-weight:500;"></span>
            <p class="grey-text">tanggal selesai</p>
        </li> -->
        <li class="collection-item avatar" style="min-height:30px;padding:2px 15px 2px 15px;">
            <span class="title hargadetailadmin" style="font-weight:500;"></span>
            <p class="grey-text">Total Harga</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 15px 2px 15px;">
            <span class="title tlpdetailadmin" style="font-weight:500;"></span>
            <p class="grey-text">No. Telp</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 15px 2px 15px;">
            <span class="title alamatdetailadmin" style="font-weight:500;"></span>
            <p class="grey-text">Alamat</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 15px 2px 15px;">
            <span class="title statusdetailadmin" style="font-weight:500;"></span>
            <p class="grey-text">Status</p>
        </li>
      </ul>

    <!-- </div> -->
  </div>

  </div>

</div>



<!-- Modal about anggota -->
<div id="modalaboutuser" class="modal">
  <div class="container" style="font-size: 15px;font-weight: bold;">
    <div class="row kurangiuser" style="margin-bottom: -0px">
      <div class="col s8">
        <p>Profil User</p>
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

  <div class="datahideuser">
  <div class="modal-content" style="margin-top: -20px">
    <!-- <div class="row"> -->
      <div class="col s12">
    <img class="materialboxed datafotouser" width="100%" height="150">
      </div>
    <!-- </div> -->
    <div class="row">

      <ul class="collection" style="width:100%;padding: 0;margin-top:0px">
        <li class="collection-item avatar" style="min-height:30px;padding:2px 25px 2px 25px;">
            <span class="title dataiduser" style="font-weight:500;"></span>
            <p class="grey-text">Id User</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 25px 2px 25px;">
            <span class="title datanamauser" style="font-weight:500;"></span>
            <p class="grey-text">Nama</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 25px 2px 25px;">
            <span class="title datatanggallahiruser" style="font-weight:500;"></span>
            <p class="grey-text">Umur</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 25px 2px 25px;">
            <span class="title datakelaminuser" style="font-weight:500;"></span>
            <p class="grey-text">Jenis kelamin</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 25px 2px 25px;">
            <span class="title datanomeruser" style="font-weight:500;"></span>
            <p class="grey-text">No.telp</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 25px 2px 25px;">
            <span class="title dataalamatuser" style="font-weight:500;"></span>
            <p class="grey-text">Alamat</p>
        </li>
      </ul>

    </div>
  </div>

  </div>

</div>

<div class="div" style="height: -30px"></div>


