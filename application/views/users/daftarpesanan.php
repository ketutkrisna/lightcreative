
<div class="minheight" style="min-height: 500px;">

<div class="row naik slides">
  <div class="col s12 center-align">
    <h5 class="da">Daftar Booking</h5>
    <hr style="width:50%;margin-top:5px;margin-bottom:0px;border:2px solid gray;">
  </div> 
</div>
<?php date_default_timezone_set('Asia/Jakarta'); ?>

<?php if(count($daftarbooking)==0){ ?>
  <h5 class="collection-item center-align" style="padding: 15px;">Tidak ada data!</h5>
<?php }else{ ?>

<ul class="collection naik viewalldaftarpesananasu" style="border-bottom: 0px">
  <?= $this->session->flashdata('message'); ?>
  <?php foreach($daftarbooking as $dbooking): ?>
  <li class="collection-item avatar" style="min-height:30px;padding:5px 18px 5px 65px;">
    <img src="<?= base_url(); ?>assets/img/users/<?= $dbooking['foto_user']; ?>" class="circle" data-idmember="">
    <span class="title"><?php if($dbooking['status_booking']=='cancel'){echo '<b>Anda</b> Cancel Pesanan '.ucwords($dbooking['bidang_member']);}else{echo '<b>Anda</b> Memesan '.ucwords($dbooking['bidang_member']);} ?></span>
    <p style="color:#757575;"><?=date('d M Y, H.i',$dbooking['tanggal_booking']); ?><?php if($dbooking['kode_booking']==$this->session->flashdata('newbooking')){ ?> <span class="red-text"> NEW </span> <?php } ?></p>
    <span style="font-size:16px;color:#757575;">Status :</span>
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
    <br>
    <?php if($dbooking['status_booking']=='ditolak'){ ?>
      <a style="font-size:11px;color:#757575;" class="pembayaran red-text">Booking anda telah ditolak.</a>
    <?php }else{ ?>
      <?php if($dbooking['notifikasi_pembayaran']=='belum'){ ?>
        <span class="red-text" style="font-size:11px;color:#757575;">Anda belum melakukan pembayaran! </span><a class="pembayaran modal-trigger" href="#modalpembayaran"><span class="blue-text lihatmodalpembayaran"
        data-idbooking="<?= $dbooking['id_booking']; ?>" style="font-size:14px">Lihat</span></a>
      <?php }else if($dbooking['notifikasi_pembayaran']=='ditolak'){ ?>
        <span class="red-text" style="font-size:11px;color:#757575;">Bukti pembayaran ditolak. </span><a class="pembayaran modal-trigger" href="#modalpembayaran"><span class="lihatmodalpembayaran blue-text"
        data-idbooking="<?= $dbooking['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
      <?php }else if($dbooking['notifikasi_pembayaran']=='diupload'){ ?>
        <span class="" style="font-size:11px;color:#757575;">Bukti pembayaran sedang diproses. </span><a class="pembayaran modal-trigger" href="#modalpembayaran"><span class="lihatmodalpembayaran blue-text"
        data-idbooking="<?= $dbooking['id_booking']; ?>" style="font-size:14px;">Lihat</span></a>
      <?php }else{ ?>
        <a style="font-size:11px;color:#757575;" class="pembayaran green-text">Bukti pembayaran diterima.</a>
      <?php } ?>
    <?php } ?>
    <span class="right" style="color:#757575;">
      <?php 
        $tglbooking  = date_create($dbooking['tanggal_awal']);
        $tglsekarang = date_create();
        $selisih  = date_diff($tglbooking, $tglsekarang);

        $date1 = new DateTime($dbooking['tanggal_awal']);
        $date3 = new DateTime($dbooking['tanggal_ahir']);
        $date2 = new DateTime(date('Y-m-d'));
      if($dbooking['status_booking']=='selesai'){
        echo "Selesai";
      }else if($dbooking['status_booking']=='ditolak'){
        echo "Ditolak";
      }else{
        if($dbooking['status_booking']=='cancel'){
          echo "Cancel";
        }else{
          if($date2<$date1){
            if($selisih->d+1==1){
              echo "Besok";
            }else{
              echo "H-".($selisih->d+1);
            }
          }else if($date2>=$date1 && $date2<=$date3){
            echo "Hari ".($selisih->days +1);
          }else if($date2>$date3){
            echo "Selesai";
          }
        }
      }
      ?>
    </span>
    <a href="#!" class="secondary-content"><i class="material-icons grey-text dropdown-trigger menuaksi" data-target='dropdaftarpesanan' data-detailbooking="<?= $dbooking['id_booking']; ?>">more_vert</i></a>
  </li>
  <?php endforeach; ?>
  <li class="collection" style="height:40px;border-bottom:0;border-left:0;border-right:0;"></li>
</ul>
<?php } ?>

</div>

<!-- Modal Structure -->
  <div id="modalpembayaran" class="modal overflowpembayaran">
    <div class="modal-content">
      <h5 style="margin-top: -3px;">Pembayaran</h5>

      <p style="margin-bottom: -10px;"><b>Cara Pembayaran</b></p>

      <p style="text-align: justify;">Untuk terus mempermudah metode pembayaran bagi para customer Light Creative, kini kami menyediakan berbagai alternatif metode pambayaran, yaitu:</p>
      <!-- <ul> -->
        <div class="container">
        <li>Mobile Banking</li>
        <li>Internet Banking</li>
        <li>SMS Banking</li>
        <li>Phone Banking</li>
        <li>ATM</li>
        <li>Transfer Bank</li>
        </div>
      <!-- </ul> -->

      <p style="margin-bottom: -0px"><b>Rekening Pembayaran Bank Lokal</b></p>

      <table class="striped s">
        <tbody>
          <tr>
            <td>Nama Bank</td>
            <td>: <span style="padding-left: 20px;font-weight: bold;">BRI</span></td>
          </tr>
          <tr>
            <td>Atas Nama</td>
            <td>: <span style="padding-left: 20px;font-weight: bold;">Wayan Rida A.</span></td>
          </tr>
          <tr>
            <td>No. Rekening</td>
            <td>: <span style="padding-left: 20px;font-weight: bold;">8054-01-000326-53-0</span></td>
          </tr>
        </tbody>
      </table>

      <p style="margin-bottom: -10px"><b>Upload Bukti Pembayaran</b></p>

      <p>Silahkan upload bukti pembayaran anda dibawah ini :</p>

      <form action="<?=base_url('users/uploadbuktipembayaran'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idpembayaran" class="idpembayaran">
        <div class="file-field input-field">
          <div class="btn-small grey" style="height: 30px;line-height: 30px">
            <span>File</span>
            <input type="file" name="fotopembayaran" required multiple>
          </div>
          <div class="file-path-wrapper">
            <input  style="height: 30px;" class="file-path validate" type="text" placeholder="Upload one or more files">
          </div>
        </div>
        <button type="submit" class="waves-effect waves-light btn-small" style="width: 100%;">Upload Bukti Pembayaran</button>
      </form>

      <p class="center-align blue-text lihatbuktiupload">Lihat Bukti Upload</p>

      <!-- <div class="row"> -->
        <div class="col s4 m7 hideupload" style="box-shadow: 0 0 0 0">
          <div class="card">
            <div class="card-image">
              <span class="isitext"></span>
              <img class="materialboxed fotobuktiajax" width="100">
              <!-- <span class="card-title">Card Title</span> -->
            </div>
          </div>
        </div>
      <!-- </div> -->

    </div>
    <!-- <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div> -->
  </div>

<!-- Dropdown Structure -->
<ul id='dropdaftarpesanan' class='dropdown-content z-depth-3'>
  <input type="hidden" class="idboking">
  <li class="detailpesanan"><a class="modal-trigger" href="#modaldetailpesanan">Detail</a></li>
  <li class="batalbookings"><a>Cancel</a></li>
  <span class="tambahbatal"></span>
</ul>


 <!-- Modal detail pesanan -->
<div id="modaldetailpesanan" class="modal">
  <div class="container" style="font-size: 15px;font-weight: bold;">
    <div class="row kurangi">
      <div class="col s8">
        <p>Detail Pesanan</p>
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
  <div class="modal-content" style="margin-top: -50px;">

    
    <div class="row">
      <ul class="collection">
        <li class="collection-item avatar green lighten-5">
          <img class="circle fotodetail">
          <span class="title namadetail">Sanji</span>
          <p class="hargadetails">Videografer</p>
          <span class="bidangdetail">0</span>
        </li>
      </ul>
    </div>

    <!-- <div class="row"> -->

      <ul class="collection" style="width:100%;padding: 0;margin-top:-40px">
        <li class="collection-item avatar" style="min-height:30px;padding:2px 15px 2px 15px;">
            <span class="title nodetailbooking" style="font-weight:600;"></span>
            <p class="grey-text">Kode Booking</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 15px 2px 15px;">
          <!-- <div class="row"> -->
            <div class="col s6 left-align" style="position: absolute;">
            <span class="title tglawaldetail" style="font-weight:500;"></span>
            <p class="grey-text">Mulai</p>
            </div>
            <div class="col s6 right-align">
            <span class="title tglahirdetail" style="font-weight:500;"></span>
            <p class="grey-text">Selesai</p>
            </div>
          <!-- </div> -->
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 15px 2px 15px;">
            <span class="title hargadetail" style="font-weight:600;"></span>
            <p class="grey-text">Total Harga</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 15px 2px 15px;">
            <span class="title tlpdetail" style="font-weight:600;"></span>
            <p class="grey-text">No. Telp</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 15px 2px 15px;">
            <span class="title alamatdetail" style="font-weight:600;"></span>
            <p class="grey-text">Alamat</p>
        </li>
        <li class="collection-item avatar" style="min-height:30px;padding:2px 15px 2px 15px;">
            <span class="title statusdetail" style="font-weight:600;"></span>
            <p class="grey-text">Status</p>
        </li>
      </ul>

  </div>

  </div>

</div>

<div class="div" style="height: -30px"></div>