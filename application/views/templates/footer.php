<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="<?=base_url('assets');?>/js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url('assets');?>/js/materialize.min.js"></script>
<!-- script template awal -->
<script type="text/javascript">
  $(document).ready(function(){

      $('.sidenav').sidenav();
      $('.materialboxed').materialbox();
      $('.scrollspy').scrollSpy();
      $('.dropdown-trigger').dropdown({
        constrainWidth:false
      });
      $('.tooltipped').tooltip();
      $('select').formSelect();
    $('.modal').modal({
      inDuration:400,
      outDuration:400
    });
      // $('.fixed-action-btn').floatingActionButton({
      //   toolbarEnabled: true
      // });
      $('.close').on('click',function(){
        $('.hideflash').fadeOut();
      });

      var position = $(window).scrollTop();
      $(window).scroll(function() {
          var wwidth = $(window).width();
          var scroll = $(window).scrollTop();
          if(wwidth>600){
            respon=65;
          }else{
            respon=50;
          }
          if(scroll > position) {
            if(wwidth<976){
              $('.navmenu').css({
                'transform':'translate(0,-'+respon+'px)',
                'position':'fixed',
                'transition':'.5s'
              });
              $('.naik').css({
                'transform':'translate(0,-40px)',
                'transition':'.5s'
              });
            }
          } else {
              $('.navmenu').css({
                'transform':'translate(0,0)',
                'position':'fixed',
                'transition':'.5s'
              });
              $('.naik').css({
                'transform':'translate(0,0px)',
                'transition':'.5s'
              });
          }
          position = scroll;
      });

      $('.cari').on('click',function(){
        $('.navmenu').slideUp(400);
        $('.pencarian').css({
          'margin-top':'0',
          'transition':'.6s'
        });
        $('.slides').css({
          'margin-top':'-100px',
          'transition':'.5s'
        });
        $('.inputcari').focus();
        $('.inputcaridatamember').focus();
        $('.inputcaridatanotifikasi').focus();
        $('.inputcaridatadaftarpesanan').focus();
        $('.naik').addClass('scrollspy');
        $('.setulang').css({
          'margin-top':'-60px',
          'transition':'.5s'
        });
      });

      $('.batal').on('click',function(){
        $('.navmenu').slideDown(400);
        $('.pencarian').css({
          'margin-top':'-62px',
          'transition':'.5s'
        });
        $('.slides').css({
          'margin-top':'0px',
          'transition':'.5s'
        });
        $('.setulang').css({
          'margin-top':'40px',
          'transition':'.5s'
        });
        $('.setulanggambar').css({
          'margin-top':'20px',
          'transition':'.5s'
        });
      });

      $('.slider').slider({
        height:300
      });
 
  });
</script>
<!-- script pemesanan -->
<script type="text/javascript">
  $(document).ready(function(){

    var baseurl='http://localhost/lightcreative/';
    $('.datepicker').datepicker({
      format:'yyyy-mm-dd'
    });

    function kapital(str)
    {  return str.replace (/\w\S*/g, 
          function(txt)
          {  return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); } );
    }

    function rubah(angka){
     var reverse = angka.toString().split('').reverse().join(''),
     ribuan = reverse.match(/\d{1,3}/g);
     ribuan = ribuan.join('.').split('').reverse().join('');
     return ribuan;
    }

    $('.loader').hide();
    $('.aboutanggota').on('click',function(e){
      $('.hideinput').hide();
      $('.hidetext').show();
      $('.editdeletemember,.editmembershow').show();
      $('.editmemberbatal,.editmembersimpan').hide();
      $('.detaildanedit').text('Profil Anggota');
      $('.loader').show();
      $('.datahidepemesanan').hide();
      var idmember=$(this).data('idmember');
      $.ajax({
        url: baseurl+'users/ajaxinfoanggota',
        method: "POST",
        data: {idmember : idmember},
        dataType: "json",
        success:function(data){
          $('.loader').hide();
          $('.datahidepemesanan').slideDown();
          var today = new Date();
          var birthday = new Date(data.tanggallahir_member);
          var year = 0;
          if (today.getMonth() < birthday.getMonth()) {
            year = 1;
          } else if ((today.getMonth() == birthday.getMonth()) && today.getDate() < birthday.getDate()) {
            year = 1;
          }
          var age = today.getFullYear() - birthday.getFullYear() - year;
         
          if(age < 0){
            age = 0;
          }
          $('.datafoto').attr('src',baseurl+'assets/img/anggota/'+data.foto_member);
          $('.datanama').text(kapital(data.nama_member));
          $('.datatanggallahir').text(age+' tahun');
          $('.datakelamin').text(kapital(data.jeniskelamin_member));
          $('.databidang').text(kapital(data.bidang_member));
          $('.dataharga').text('Rp '+rubah(data.harga_member)+'/hari');
          $('.bintang').text(data.count);
          $('.dataalamat').text(kapital(data.alamat_member));
          $('.datanotlp').text(data.nomertelepon_member);
          $('.datatgllahir').text(data.tanggallahir_member);
          $('.dataemail').text(data.email_member);
          $('.datastatus').text(kapital(data.status_member));

          $('.namamemberedit').val(data.nama_member);
          $('.alamatmemberedit').val(data.alamat_member);
          $('.tlpmemberedit').val(data.nomertelepon_member);
          $('.kelaminmemberedit').val(data.jeniskelamin_member);
          $('#lahirmemberedits').val(data.tanggallahir_member);
          $('.bidangmemberedit').val(data.bidang_member);
          $('.hargamemberedit').val(data.harga_member);
          $('.emailmemberedit').val(data.email_member);
          $('.statusmemberedit').val(data.status_member);
          $('.idmemberlama').val(data.id_member);

          $('.editdeletemember').attr('href',baseurl+'admin/hapusmember/'+data.id_member);
        }
      });
    });

    // $('.loader').hide();
    $('.booking').on('click',function(){
      $('.ok').addClass('disabled');
      $('.datepicker').val('');
      $('.total').text('0');
      $('.loader').show();
      $('.datahide').hide();
      $('.notiftgl').hide();
      $('.teleponuser').val('');
      $('.alamatuser').val('');
      $('.kurangi').css('margin-bottom','-10px');
      var idmember=$(this).data('idmember');
      $.ajax({
        url: baseurl+'users/ajaxinfoanggota',
        method: "POST",
        data: {idmember : idmember},
        dataType: "json",
        success:function(data){
          $('.kurangi').css('margin-bottom','0px');
          $('.loader').hide();
          $('.datahide').slideDown();
          $('.fotobooking').attr('src',baseurl+'assets/img/anggota/'+data.foto_member);
          $('.namabooking').text(kapital(data.nama_member));
          $('.bidangbooking').text(kapital(data.bidang_member));
          $('.idmember').val(data.id_member);
          $('.hargamember').val(data.harga_member);
          $('.detailstarharga').text('Rp '+rubah(data.harga_member)+'/Hari');
        }
      });
    });

    $('.alamatuser').on('keyup',function(){
      $('.notifalamat').text('');
      var hari = 24*60*60*1000; // format perhitungan dalam 1 hari
      var tgl_1 = new Date($('.tanggalawal').val());
      var tgl_2 = new Date($('.tanggalahir').val());
      var total_hari = Math.round(Math.round((tgl_2.getTime() - tgl_1.getTime()) / hari+1));
      $('.total').text(rubah(total_hari*$('.hargamember').val()));
      $('.totalbooking').val(total_hari*$('.hargamember').val());
      var idmembercek=$('.idmember').val();
      var tanggalpertama=$('.tanggalawal').val();
      var tanggalkedua=$('.tanggalahir').val();
      var alamatuser=$('.alamatuser').val();
      var teleponuser=$('.teleponuser').val();
      $.ajax({
        url: baseurl+'users/cekbooking',
        method: "POST",
        data: {idmembercek : idmembercek,
          tanggalpertama : tanggalpertama,
          tanggalkedua : tanggalkedua,
          alamatuser : alamatuser,
          teleponuser : teleponuser
        },
        dataType: "text",
        success:function(data){
          // console.log(data);
          if(data=='Alamat tidak boleh kosong!'){
            $('.ok').addClass('disabled');
            $('.notifalamat').text('Alamat tidak boleh kosong!');
            return false;
          }else if(data=='Telepon tidak boleh kosong!'){
            $('.ok').addClass('disabled');
            $('.notiftlp').text('Tlp tidak boleh kosong!');
            return false;
          }else if(data=='Tanggal AWAL harus lebih kecil dari tanggal AHIR!'){
            $('.ok').addClass('disabled');
            $('.total').text('0');
            $('.notiftgl').text('Tanggal AWAL harus lebih kecil dari tanggal AHIR atau sama dengan tanggal AHIR!');
            $('.notiftgl').show();
            return false;
          }
          // else if(data=='gagal'){
          //   $('.ok').addClass('disabled');
          //   $('.total').text('0');
          //   $('.notiftgl').text('Silahkan pilih tanggal lain / pilih member lain, karena member ini sudah dibooking pada tanggal yang anda pilih!');
          //   $('.notiftgl').show();
          //   return false;
          // }
          else if(data=='ok'){
            $('.ok').removeClass('disabled');
            $('.notiftgl').hide();
          }else if(data='Harus diatas tanggal sekarang!'){
            $('.ok').addClass('disabled');
            $('.total').text('0');
            $('.notiftgl').text('Harus diatas tanggal hari ini!');
            $('.notiftgl').show();
          }
        }
      });
    });

     $('.teleponuser').on('keyup',function(){
      $('.notiftlp').text('');
      var hari = 24*60*60*1000; // format perhitungan dalam 1 hari
      var tgl_1 = new Date($('.tanggalawal').val());
      var tgl_2 = new Date($('.tanggalahir').val());
      var total_hari = Math.round(Math.round((tgl_2.getTime() - tgl_1.getTime()) / hari+1));
      $('.total').text(rubah(total_hari*$('.hargamember').val()));
      $('.totalbooking').val(total_hari*$('.hargamember').val());
      var idmembercek=$('.idmember').val();
      var tanggalpertama=$('.tanggalawal').val();
      var tanggalkedua=$('.tanggalahir').val();
      var alamatuser=$('.alamatuser').val();
      var teleponuser=$('.teleponuser').val();
      $.ajax({
        url: baseurl+'users/cekbooking',
        method: "POST",
        data: {idmembercek : idmembercek,
          tanggalpertama : tanggalpertama,
          tanggalkedua : tanggalkedua,
          alamatuser : alamatuser,
          teleponuser : teleponuser
        },
        dataType: "text",
        success:function(data){
          if(data=='Alamat tidak boleh kosong!'){
            $('.ok').addClass('disabled');
            $('.notifalamat').text('Alamat tidak boleh kosong!');
            return false;
          }else if(data=='Telepon tidak boleh kosong!'){
            $('.ok').addClass('disabled');
            $('.notiftlp').text('Tlp tidak boleh kosong!');
            return false;
          }else if(data=='Tanggal AWAL harus lebih kecil dari tanggal AHIR!'){
            $('.ok').addClass('disabled');
            $('.total').text('0');
            $('.notiftgl').text('Tanggal AWAL harus lebih kecil dari tanggal AHIR atau sama dengan tanggal AHIR!');
            $('.notiftgl').show();
            return false;
          }
          // else if(data=='gagal'){
          //   $('.ok').addClass('disabled');
          //   $('.total').text('0');
          //   $('.notiftgl').text('Silahkan pilih tanggal lain / pilih member lain, karena member ini sudah dibooking pada tanggal yang anda pilih!');
          //   $('.notiftgl').show();
          //   return false;
          // }
          else if(data=='ok'){
            $('.ok').removeClass('disabled');
            $('.notiftgl').hide();
          }else if(data='Harus diatas tanggal sekarang!'){
            $('.ok').addClass('disabled');
            $('.total').text('0');
            $('.notiftgl').text('Harus diatas tanggal hari ini!');
            $('.notiftgl').show();
          }
        }
      });
    });

    $('.tanggalahir').on('change',function(){
      var hari = 24*60*60*1000; // format perhitungan dalam 1 hari
      var tgl_1 = new Date($('.tanggalawal').val());
      var tgl_2 = new Date($('.tanggalahir').val());
      var total_hari = Math.round(Math.round((tgl_2.getTime() - tgl_1.getTime()) / hari+1));
      $('.total').text(rubah(total_hari*$('.hargamember').val()));
      $('.totalbooking').val(total_hari*$('.hargamember').val());
      var idmembercek=$('.idmember').val();
      var tanggalpertama=$('.tanggalawal').val();
      var tanggalkedua=$('.tanggalahir').val();
      var alamatuser=$('.alamatuser').val();
      var teleponuser=$('.teleponuser').val();
      $.ajax({
        url: baseurl+'users/cekbooking',
        method: "POST",
        data: {idmembercek : idmembercek,
          tanggalpertama : tanggalpertama,
          tanggalkedua : tanggalkedua,
          alamatuser : alamatuser,
          teleponuser : teleponuser
        },
        dataType: "text",
        success:function(data){
          if(data=='Alamat tidak boleh kosong!'){
            $('.ok').addClass('disabled');
            $('.notifalamat').text('Alamat tidak boleh kosong!');
            return false;
          }else if(data=='Telepon tidak boleh kosong!'){
            $('.ok').addClass('disabled');
            $('.notiftlp').text('Tlp tidak boleh kosong!');
            return false;
          }else if(data=='Tanggal AWAL harus lebih kecil dari tanggal AHIR!'){
            $('.ok').addClass('disabled');
            $('.total').text('0');
            $('.notiftgl').text('Tanggal AWAL harus lebih kecil dari tanggal AHIR atau sama dengan tanggal AHIR!');
            $('.notiftgl').show();
            return false;
          }
          // else if(data=='gagal'){
          //   $('.ok').addClass('disabled');
          //   $('.total').text('0');
          //   $('.notiftgl').text('Silahkan pilih tanggal lain / pilih member lain, karena member ini sudah dibooking pada tanggal yang anda pilih!');
          //   $('.notiftgl').show();
          //   return false;
          // }
          else if(data=='ok'){
            $('.ok').removeClass('disabled');
            $('.notiftgl').hide();
          }else if(data='Harus diatas tanggal sekarang!'){
            $('.ok').addClass('disabled');
            $('.total').text('0');
            $('.notiftgl').text('Harus diatas tanggal hari ini!');
            $('.notiftgl').show();
          }
        }
      });
    });

    $('.tanggalawal').on('change',function(){
      var hari = 24*60*60*1000; // format perhitungan dalam 1 hari
      var tgl_1 = new Date($('.tanggalawal').val());
      var tgl_2 = new Date($('.tanggalahir').val());
      var total_hari = Math.round(Math.round((tgl_2.getTime() - tgl_1.getTime()) / hari+1));
      $('.total').text(rubah(total_hari*$('.hargamember').val()));
      $('.totalbooking').val(total_hari*$('.hargamember').val());
      var idmembercek=$('.idmember').val();
      var tanggalpertama=$('.tanggalawal').val();
      var tanggalkedua=$('.tanggalahir').val();
      var alamatuser=$('.alamatuser').val();
      var teleponuser=$('.teleponuser').val();
      $.ajax({
        url: baseurl+'users/cekbooking',
        method: "POST",
        data: {idmembercek : idmembercek,
          tanggalpertama : tanggalpertama,
          tanggalkedua : tanggalkedua,
          alamatuser : alamatuser,
          teleponuser : teleponuser
        },
        dataType: "text",
        success:function(data){
          if(data=='Alamat tidak boleh kosong!'){
            $('.ok').addClass('disabled');
            $('.notifalamat').text('Alamat tidak boleh kosong!');
            return false;
          }else if(data=='Telepon tidak boleh kosong!'){
            $('.ok').addClass('disabled');
            $('.notiftlp').text('Tlp tidak boleh kosong!');
            return false;
          }else if(data=='Tanggal AWAL harus lebih kecil dari tanggal AHIR!'){
            $('.ok').addClass('disabled');
            $('.total').text('0');
            $('.notiftgl').text('Tanggal AWAL harus lebih kecil dari tanggal AHIR atau sama dengan tanggal AHIR!');
            $('.notiftgl').show();
            return false;
          }
          // else if(data=='gagal'){
          //   $('.ok').addClass('disabled');
          //   $('.total').text('0');
          //   $('.notiftgl').text('Silahkan pilih tanggal lain / pilih member lain, karena member ini sudah dibooking pada tanggal yang anda pilih!');
          //   $('.notiftgl').show();
          //   return false;
          // }
          else if(data=='ok'){
            $('.ok').removeClass('disabled');
            $('.notiftgl').hide();
          }else if(data='Harus diatas tanggal sekarang!'){
            $('.ok').addClass('disabled');
            $('.total').text('0');
            $('.notiftgl').text('Harus diatas tanggal hari ini!');
            $('.notiftgl').show();
          }
        }
      });
    });

    $('.star').on('click',function(e){
      var idstar=$(this).data('star');
      $.ajax({
        url: baseurl+'users/ajaxtambahstar',
        method: "POST",
        data: {idstar : idstar},
        dataType: "text",
        success:function(data){
          if(data=='success'){
            document.location.href=baseurl+'users/pemesanan';
          }else{
            alert('member tidak ada!');
            return false;
          }
        }
      });
      e.stopPropagation();
    });

    $('body').on('click','.menuaksi',function(){
      var idbooking=$(this).data('detailbooking');
      $('#dropdaftarpesanan').hide();
      $('.datahide').hide();
      $.ajax({
        url: baseurl+'users/ajaxdetailpesanan',
        method: "POST",
        data: {idbooking : idbooking},
        dataType: "json",
        success:function(data){
          $('.datahide').show();
          $('#dropdaftarpesanan').show();
          $('.fotodetail').attr('src',baseurl+'assets/img/anggota/'+data.foto_member);
          $('.namadetail').text(kapital(data.nama_member));
          $('.bidangdetail').text(kapital(data.bidang_member));
          $('.hargadetails').text('Rp '+rubah(data.harga_member)+'/Hari');
          $('.alamatdetail').text(kapital(data.alamat_booking));
          $('.tlpdetail').text(data.nomertelepon_booking);
          $('.tglawaldetail').text(data.tanggal_awal);
          $('.tglahirdetail').text(data.tanggal_ahir);
          $('.nodetailbooking').text(data.kode_booking);
          $('.hargadetail').text('Rp '+rubah(data.harga_booking));
          $('.statusdetail').text(kapital(data.status_booking));
          $('.idboking').val(data.id_booking);
        }
      });
    });

    $('.batalbookings').on('click',function(e){
      var cancel=confirm('yakin ingin dicancel?');
      if(cancel==false){
        return false;
      }else{
        var idboking=$('.idboking').val();
        e.preventDefault();
        $.ajax({
          url: baseurl+'users/batalbooking',
          method: "POST",
          data: {idbooking : idboking},
          dataType:"text",
          success:function(data){
            if(data=='tidak bisa dibatalkan'){
              alert('Tidak bisa dicancel jika sudah dalam proses,selesai,cancel!');
              return false;
            }else{
              document.location.href=baseurl+'users/daftarpesanan';
            }
          }
        });
      }
    });

    $('.themeteal').on('change',function(){
      var valueteal=$('.valueteal').val();
      $.ajax({
        url: baseurl+'users/ubahtema',
        method: "POST",
        data: {valuetheme : valueteal},
        dataType: "text",
        success:function(data){
          if(data=='success'){
            document.location.href=baseurl+'users';
          }
        }
      });
    });
    $('.themeblue').on('change',function(){
      var valueblue=$('.valueblue').val();
      $.ajax({
        url: baseurl+'users/ubahtema',
        method: "POST",
        data: {valuetheme : valueblue},
        dataType: "text",
        success:function(data){
          if(data=='success'){
            document.location.href=baseurl+'users';
          }
        }
      });
    });
    $('.themegreydark').on('change',function(){
      var valuegreydark=$('.valuegreydark').val();
      $.ajax({
        url: baseurl+'users/ubahtema',
        method: "POST",
        data: {valuetheme : valuegreydark},
        dataType: "text",
        success:function(data){
          if(data=='success'){
            document.location.href=baseurl+'users';
          }
        }
      });
    });
    $('.themered').on('change',function(){
      var valuered=$('.valuered').val();
      $.ajax({
        url: baseurl+'users/ubahtema',
        method: "POST",
        data: {valuetheme : valuered},
        dataType: "text",
        success:function(data){
          if(data=='success'){
            document.location.href=baseurl+'users';
          }
        }
      });
    });
    $('.themeorange').on('change',function(){
      var valueorange=$('.valueorange').val();
      $.ajax({
        url: baseurl+'users/ubahtema',
        method: "POST",
        data: {valuetheme : valueorange},
        dataType: "text",
        success:function(data){
          if(data=='success'){
            document.location.href=baseurl+'users';
          }
        }
      });
    });

    $('.hideupload').hide();
    $('.lihatbuktiupload').on('click',function(){
      $('.hideupload').slideToggle();
    });

    $('.lihatmodalpembayaran').on('click',function(){
      var idpembayaran=$(this).data('idbooking');
      $('.idpembayaran').val(idpembayaran);
      setTimeout(function() {
        $('.overflowpembayaran').scrollTop($('.overflowpembayaran')[0]);
        $('.hideupload').slideUp();
      }, 10);
    });

    $('.lihatmodalpembayaran').on('click',function(){
      var idpembayaran=$(this).data('idbooking');

      $.ajax({
        url: baseurl+'users/ajaxdetailpesanan',
        method: "POST",
        data: {idbooking : idpembayaran},
        dataType: "json",
        success:function(data){
          if(data.bukti_pembayaran==''){
            $('.fotobuktiajax').hide();
            $('.isitext').show();
            $('.isitext').html(`
                                <p class="center-align">Kosong!</p>
                              `);
          }else{
            $('.isitext').hide();
            $('.fotobuktiajax').show();
            $('.fotobuktiajax').attr('src',baseurl+'/assets/img/pembayaran/'+data.bukti_pembayaran);
          }
        }
      });
    });

    $('.lihatmodalpembayaranadmin').on('click',function(){
      var idpembayaranadmin=$(this).data('idbooking');
      $('.idterimaadmin').val(idpembayaranadmin);
      setTimeout(function() {
        $('.overflowpembayaran').scrollTop($('.overflowpembayaran')[0]);
        $('.hideupload').slideUp();
      }, 10);
    });

    $('.lihatmodalpembayaranadmin').on('click',function(){
      var idpembayaranadmin=$(this).data('idbooking');
      $('.hidebuktiadmin').hide();
      $('.loader').show();
      $.ajax({
        url: baseurl+'admin/ajaxdetailpesananuser',
        method: "POST",
        data: {idbooking : idpembayaranadmin},
        dataType: "json",
        success:function(data){
          $('.loader').hide();
          $('.hidebuktiadmin').show();
          $('.buktipembayarandiadmin').attr('src',baseurl+'/assets/img/pembayaran/'+data.bukti_pembayaran);
        }
      });
    });


  });
</script>
<!-- script admin -->
<script type="text/javascript">
  $(document).ready(function(){

    function kapital(str)
    {  return str.replace (/\w\S*/g, 
          function(txt)
          {  return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); } );
    }

    function rubah(angka){
     var reverse = angka.toString().split('').reverse().join(''),
     ribuan = reverse.match(/\d{1,3}/g);
     ribuan = ribuan.join('.').split('').reverse().join('');
     return ribuan;
   }
    var baseurl='http://localhost/lightcreative/';

    $('.settingnotifikasi').on('click',function(e){
      e.stopPropagation();
      // $('.tambahbatal').html('');
      $('.tambahbatal').hide();
      $('#settingorderan').hide();
      var idb=$(this).data('idbooking');
      $.ajax({
        url: baseurl+'admin/ajaxdetailpesananuser',
        method: "POST",
        data: {idbooking : idb},
        dataType: "json",
        success:function(data){
          $('#settingorderan').show();
          $('.idviewbooking').val(data.id_booking);
          if(data.status_booking=='menunggu'){
            $('#settingorderan').css('height','150px');
            $('.tambahbatal').show();
            $('.datapilihanok').text('Konfirmasi');
            $('.datapilihanok').attr('href',baseurl+'admin/ajaxconfirmbooking/'+data.id_booking);
            $('.tolakpesanan').attr('href',baseurl+'admin/tolakpesananuser/'+data.id_booking);
          }else if(data.status_booking=='dikonfirmasi'){
            $('#settingorderan').css('height','100px');
            $('.datapilihanok').text('Proses');
            $('.datapilihanok').attr('href',baseurl+'admin/ajaxprosesbooking/'+data.id_booking);
          }else if(data.status_booking=='dalam proses'){
            $('#settingorderan').css('height','100px');
            $('.datapilihanok').text('Selesai');
            $('.datapilihanok').attr('href',baseurl+'admin/ajaxtutupbooking/'+data.id_booking);
          }else if(data.status_booking=='cancel' && data.notifikasi_booking=='belum dibaca'){
            $('#settingorderan').css('height','100px');
            $('.datapilihanok').text('Ok Cancel');
            $('.datapilihanok').attr('href',baseurl+'admin/ajaxupdatecancel/'+data.id_booking);
          }else if(data.status_booking=='ditolak'){
            $('#settingorderan').css('height','100px');
            $('.datapilihanok').text('Tutup');
            $('.datapilihanok').attr('href','#!');
          }else{
            $('#settingorderan').css('height','100px');
            $('.datapilihanok').text('Tutup');
            $('.datapilihanok').attr('href','#!');
          }

          $('.loader').hide();
          $('.datahide').slideDown();
          $('.fotodetailadmin').attr('src',baseurl+'assets/img/anggota/'+data.foto_member);
          $('.namadetailadmin').text(kapital(data.nama_member));
          $('.bidangdetailadmin').text(kapital(data.bidang_member));
          $('.alamatdetailadmin').text(kapital(data.alamat_booking));
          $('.tlpdetailadmin').text(data.nomertelepon_booking);
          $('.kodedetailbooking').text(data.kode_booking);
          $('.tgldetailmulai').text(data.tanggal_awal);
          $('.tgldetailselesai').text(data.tanggal_ahir);
          $('.hargadetailadmin').text('Rp '+rubah(data.harga_booking));
          $('.statusdetailadmin').text(kapital(data.status_booking));
          $('.idbokingadmin').val(data.id_booking);
          $('.sukaadminharga').text('Rp '+rubah(data.harga_member)+'/Hari');
        }
      });
    });

    // $('.datahide').hide();
    // $('.detailnotifikasiadmin').on('click',function(){
    //   var idbookinguser=$(this).data('idbookinguser');
    //   $('.datahide').hide();
    //   $('.loader').show();
    //   $.ajax({
    //     url: baseurl+'admin/ajaxdetailpesananuser',
    //     method: "POST",
    //     data: {idbooking : idbookinguser},
    //     dataType: "json",
    //     success:function(data){
    //       console.log(data);
    //       $('.loader').hide();
    //       $('.datahide').slideDown();
    //       $('.fotodetailadmin').attr('src',baseurl+'assets/img/anggota/'+data.foto_member);
    //       $('.namadetailadmin').text(data.nama_member);
    //       $('.bidangdetailadmin').text(data.bidang_member);
    //       $('.alamatdetailadmin').text(data.alamat_booking);
    //       $('.tlpdetailadmin').text(data.nomertelepon_booking);
    //       $('.kodedetailbooking').text(data.kode_booking);
    //       $('.tgldetailmulai').text(data.tanggal_awal);
    //       $('.tgldetailselesai').text(data.tanggal_ahir);
    //       $('.hargadetailadmin').text('Rp '+rubah(data.harga_booking));
    //       $('.statusdetailadmin').text(data.status_booking);
    //       $('.idbokingadmin').val(data.id_booking);
    //       $('.sukaadmin').text(data.count);
    //     }
    //   });
    // });

    $('.detailuserbooking').on('click',function(e){
      $('.loader').show();
      $('.datahideuser').hide();
      var iddetailuser=$(this).data('idbookinguser');
      $.ajax({
        url: baseurl+'admin/ajaxdetailpesananuser',
        method: "POST",
        data: {idbooking : iddetailuser},
        dataType: "json",
        success:function(data){
          $('.loader').hide();
          $('.datahideuser').slideDown();
          var today = new Date();
          var birthday = new Date(data.tanggallahir_user);
          var year = 0;
          if (today.getMonth() < birthday.getMonth()) {
            year = 1;
          } else if ((today.getMonth() == birthday.getMonth()) && today.getDate() < birthday.getDate()) {
            year = 1;
          }
          var age = today.getFullYear() - birthday.getFullYear() - year;
         
          if(age < 0){
            age = 0;
          }
          $('.datafotouser').attr('src',baseurl+'assets/img/users/'+data.foto_user);
          $('.dataiduser').text('USER00'+data.id_user);
          $('.datanamauser').text(kapital(data.nama_user));
          $('.datatanggallahiruser').text(age+' Tahun');
          $('.datakelaminuser').text(kapital(data.jeniskelamin_user));
          $('.datanomeruser').text(data.nomertelepon_user);
          $('.dataalamatuser').text(kapital(data.alamat_user));
        }
      });
    });

    $('.confirmasipesanan').on('click',function(e){
      e.stopPropagation();
    });

    $('.hapuspesanan').on('click',function(e){
      e.stopPropagation();
    });

    $('.modaltambahgaleri').on('click',function(){
      $('.fotogaleri,.hilangvaluetext,.deskripsi,.pilihmember').val('');
      $('.tambahgaleri').addClass('disabled');
      // $('#modaltambahgaleri').slideDown('slow');
    });

    $('.pilihmenugaleri').on('click',function(){
      var idgaleri=$(this).data('idgaleri');
      $('.labelaktif').addClass('active');
      $('.hilangvalue,.fotogaleriedit').val('');
      $('#downgalery').hide();
      $('.tambahgaleriedit').removeClass('disabled');

      $.ajax({
        url: baseurl+'admin/editgaleriinfo',
        method: "POST",
        data: {idgaleri : idgaleri},
        dataType: "json",
        success:function(data){
          $('#downgalery').show();
          $('.datafotogalerilama').attr('src',baseurl+'assets/img/galery/'+data.foto_galeri);
          $('.deskripsigaleriedit').val(data.deskripsi_galeri);
          $('.pilihmemberedit').val(data.id_member);
          $('.editgalerilama').val(data.id_galeri);
          $('.hapusgalerifoto').attr('href',baseurl+'admin/hapusgalerifoto/'+data.id_galeri);
        }
      });
    });

      $('.tambahgaleri').addClass('disabled');
    $('.fotogaleri').on('change',function(){
      if($('.fotogaleri').val().length==0||$('.deskripsi').val().length==0||$('.pilihmember').val().length==0){
        $('.tambahgaleri').addClass('disabled');
      }else{
        $('.tambahgaleri').removeClass('disabled');
      }
    });

    $('.deskripsi').on('keyup',function(){
      if($('.fotogaleri').val().length==0||$('.deskripsi').val().length==0||$('.pilihmember').val().length==0){
        $('.tambahgaleri').addClass('disabled');
      }else{
        $('.tambahgaleri').removeClass('disabled');
      }
    });

    $('.pilihmember').on('change',function(){
      if($('.fotogaleri').val().length==0||$('.deskripsi').val().length==0||$('.pilihmember').val().length==0){
        $('.tambahgaleri').addClass('disabled');
      }else{
        $('.tambahgaleri').removeClass('disabled');
      }
    });

     
    $('.deskripsigaleriedit').on('keyup',function(){
      if($('.deskripsigaleriedit').val().length==0){
        $('.tambahgaleriedit').addClass('disabled');
      }else{
        $('.tambahgaleriedit').removeClass('disabled');
      }
    });

      $('.hideinput').hide();
      $('.editmemberbatal,.editmembersimpan').hide();
    $('.editmembershow').on('click',function(){
      $('.detaildanedit').text('Edit Anggota');
      $('.hideinput').show();
      $('.hidetext').hide();
      $('.editmemberbatal,.editmembersimpan').show();
      $('.editdeletemember,.editmembershow').hide();
      $('#modalaboutanggota .datahidepemesanan label').addClass('active');
    });

    $('.tooltipped').on('click',function(e){
      e.stopPropagation();
    });

    // $('.hidecancel').hide();
    // $('.hideselesai').hide();
    // $('.hideproses').hide();
    // $('.hidekonfirmasi').hide();
    // $('body .showkonfirmasi').on('click',function(){
    //   $('body .hidekonfirmasi').slideToggle();
    // });
    // $('body .showproses').on('click',function(){
    //   $('body .hideproses').slideToggle();
    // });
    // $('body .showselesai').on('click',function(){
    //   $('body .hideselesai').slideToggle();
    // });
    // $(' body .showcancel').on('click',function(){
    //   $('body .hidecancel').slideToggle();
    // });


  });
</script>
</body>
</html>