<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('level_user')!='admin'){
			redirect('users');
		}
	}

	public function index()
	{
		$data['title']='notifikasi';
		$datacarinull=htmlspecialchars($this->input->post('inputcaridatanotifikasi',true));
		$datasorting=htmlspecialchars($this->input->post('sorting',true));
	    $datacarifilter = preg_replace('/\s+/', ' ', trim($datacarinull));

		$querycount="SELECT count(*) as totalcount FROM bookings where notifikasi_booking='belum dibaca'";
		$data['countnotifikasi']=$this->db->query($querycount)->row_array();
		$data['profil']=$this->db->get_where('users',['id_user'=>$this->session->userdata('id_user')])->row_array();
		// $querybooking="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` JOIN `members` ON `bookings`.`member_id`=`members`.`id_member` ORDER BY `id_booking` DESC";
		// $data['viewbookingadmin']=$this->db->query($querybooking)->result_array();

		$countmenunggu="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE status_booking='menunggu' and notifikasi_booking='belum dibaca' ORDER BY `id_booking` DESC";
		$data['menunggu']=$this->db->query($countmenunggu)->result_array();
		$countkonfirmasi="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE status_booking='dikonfirmasi' ORDER BY `id_booking` DESC";
		$data['konfirmasi']=$this->db->query($countkonfirmasi)->result_array();
		$countproses="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE status_booking='dalam proses' ORDER BY `id_booking` DESC";
		$data['proses']=$this->db->query($countproses)->result_array();
		$countselesai="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE status_booking='selesai' ORDER BY `id_booking` DESC";
		$data['selesai']=$this->db->query($countselesai)->result_array();
		$countcancel="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE `status_booking`='cancel' and `notifikasi_booking`='dibaca' ORDER BY `id_booking` DESC";
		$data['canceldibaca']=$this->db->query($countcancel)->result_array();
		$countcancelblm="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE `status_booking`='cancel' and `notifikasi_booking`='belum dibaca' ORDER BY `id_booking` DESC";
		$data['cancelbelum']=$this->db->query($countcancelblm)->result_array();
		$countditolak="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE `status_booking`='ditolak' ORDER BY `id_booking` DESC";
		$data['ditolak']=$this->db->query($countditolak)->result_array();
		
		if($datacarifilter){
			$data['valuecari']=$datacarifilter;

			$countmenunggu="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE (`status_booking`='menunggu' and `notifikasi_booking`='belum dibaca') and (`nama_user` LIKE '%$datacarifilter%' or `kode_booking` LIKE '%$datacarifilter%') ORDER BY `id_booking` DESC";
			$data['menunggu']=$this->db->query($countmenunggu)->result_array();
			$countkonfirmasi="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE status_booking='dikonfirmasi' and (`nama_user` LIKE '%$datacarifilter%' or `kode_booking` LIKE '%$datacarifilter%') ORDER BY `id_booking` DESC";
			$data['konfirmasi']=$this->db->query($countkonfirmasi)->result_array();
			$countproses="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE status_booking='dalam proses' and (`nama_user` LIKE '%$datacarifilter%' or `kode_booking` LIKE '%$datacarifilter%') ORDER BY `id_booking` DESC";
			$data['proses']=$this->db->query($countproses)->result_array();
			$countselesai="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE status_booking='selesai' and (`nama_user` LIKE '%$datacarifilter%' or `kode_booking` LIKE '%$datacarifilter%') ORDER BY `id_booking` DESC";
			$data['selesai']=$this->db->query($countselesai)->result_array();
			$countcancel="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE (`status_booking`='cancel' and `notifikasi_booking`='dibaca') and (`nama_user` LIKE '%$datacarifilter%' or `kode_booking` LIKE '%$datacarifilter%') ORDER BY `id_booking` DESC";
			$data['canceldibaca']=$this->db->query($countcancel)->result_array();
			$countcancelblm="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE (`status_booking`='cancel' and `notifikasi_booking`='belum dibaca') and (`nama_user` LIKE '%$datacarifilter%' or `kode_booking` LIKE '%$datacarifilter%') ORDER BY `id_booking` DESC";
			$data['cancelbelum']=$this->db->query($countcancelblm)->result_array();
			$countditolak="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` WHERE (`status_booking`='ditolak' and `notifikasi_booking`='dibaca') and (`nama_user` LIKE '%$datacarifilter%' or `kode_booking` LIKE '%$datacarifilter%') ORDER BY `id_booking` DESC";
			$data['ditolak']=$this->db->query($countditolak)->result_array();

			$querybooking="SELECT users.*,bookings.*,members.*,datediff(tanggal_ahir,tanggal_awal) as selisih FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` JOIN `members` ON `bookings`.`member_id`=`members`.`id_member` WHERE `nama_user` LIKE '%$datacarifilter%' or `kode_booking` LIKE '%$datacarifilter%' ORDER BY `id_booking` DESC";
			$data['viewbookingadmin']=$this->db->query($querybooking)->result_array();
			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('admin/notifikasi',$data);
			$this->load->view('templates/footer');
		}else{
			$data['valuecari']=$datacarifilter;
			$data['sorting']=$datasorting;
			if($datasorting=="TERBANYAK"){
				$querybooking="SELECT users.*,bookings.*,members.*,datediff(tanggal_ahir,tanggal_awal) as selisih FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` JOIN `members` ON `bookings`.`member_id`=`members`.`id_member` ORDER BY `selisih` DESC";
				$data['viewbookingadmin']=$this->db->query($querybooking)->result_array();
				$this->load->view('templates/header',$data);
				$this->load->view('templates/navbar',$data);
				$this->load->view('templates/sidebar',$data);
				$this->load->view('admin/notifikasi',$data);
				$this->load->view('templates/footer');
			}else if($datasorting==""){
				$querybooking="SELECT users.*,bookings.*,members.*,datediff(tanggal_ahir,tanggal_awal) as selisih FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` JOIN `members` ON `bookings`.`member_id`=`members`.`id_member` ORDER BY `tanggal_awal`, `selisih` desc";
				$data['viewbookingadmin']=$this->db->query($querybooking)->result_array();

				// $asu=count($data['viewbookingadmin']=$this->db->query($querybooking)->result_array());
				// var_dump($asu);die;

				// $query="SELECT count(tanggal_awal) as count from bookings group by tanggal_awal ORDER by count(tanggal_awal) desc";
				// $cetak=$this->db->query($query)->result_array();
				// var_dump($cetak);die;
				$this->load->view('templates/header',$data);
				$this->load->view('templates/navbar',$data);
				$this->load->view('templates/sidebar',$data);
				$this->load->view('admin/notifikasi',$data);
				$this->load->view('templates/footer');
			}else{
				$querybooking="SELECT users.*,bookings.*,members.*,datediff(tanggal_ahir,tanggal_awal) as selisih FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` JOIN `members` ON `bookings`.`member_id`=`members`.`id_member` ORDER BY `id_booking` $datasorting";
				$data['viewbookingadmin']=$this->db->query($querybooking)->result_array();
				$this->load->view('templates/header',$data);
				$this->load->view('templates/navbar',$data);
				$this->load->view('templates/sidebar',$data);
				$this->load->view('admin/notifikasi',$data);
				$this->load->view('templates/footer');
			}
		}

		// if($datasorting){
		// 	$querybooking="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` JOIN `members` ON `bookings`.`member_id`=`members`.`id_member` ORDER BY `id_booking` $datasorting";
		// 	$data['viewbookingadmin']=$this->db->query($querybooking)->result_array();
		// 	$this->load->view('templates/header',$data);
		// 	$this->load->view('templates/navbar',$data);
		// 	$this->load->view('templates/sidebar',$data);
		// 	$this->load->view('admin/notifikasi',$data);
		// 	$this->load->view('templates/footer');
		// }
	}

	public function tolakpesananuser($id)
	{
		$idurl=htmlspecialchars($id);
		$cek=$this->db->get_where('bookings',['id_booking'=>$idurl])->row_array();
		$this->db->set('status_booking', 'ditolak');
		$this->db->set('notifikasi_booking', 'dibaca');
		$this->db->where('id_booking', $idurl);
		// $this->db->where('user_id', $iduser);
		$this->db->update('bookings');

		$this->session->set_flashdata('newnotif',$cek['kode_booking']);
		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Kode booking <b>'.$cek['kode_booking'].'</b> ditolak, Hub.<b>'.$cek['nomertelepon_booking'].'</b> untuk menginformasikan!</span></li>');
		redirect('admin');
		// echo "success";
	}

	public function terimabuktipembayaran()
	{
		$idterimaadmin=htmlspecialchars($this->input->post('idterimaadmin',true));

		$this->db->set('notifikasi_pembayaran', 'diterima');
		$this->db->where('id_booking', $idterimaadmin);
		$this->db->update('bookings');

		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Bukti pembayaran berhasil <b>diterima</b>!</span></li>');
		redirect('admin');
		return false;
	}

	public function tolakbuktipembayaran()
	{
		$idtolakadmin=htmlspecialchars($this->input->post('idtolakadmin',true));

		$this->db->set('notifikasi_pembayaran', 'ditolak');
		$this->db->where('id_booking', $idtolakadmin);
		$this->db->update('bookings');

		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Bukti pembayaran anda <b>ditolak</b>!</span></li>');
		redirect('admin');
		return false;
	}

	public function ajaxconfirmbooking($id)
	{
		$idvaluebooking=htmlspecialchars($id);
		$cek=$this->db->get_where('bookings',['id_booking'=>$idvaluebooking])->row_array();
		if($cek['status_booking']=='menunggu'){
			$this->db->set('notifikasi_booking', 'dibaca');
			$this->db->set('status_booking', 'dikonfirmasi');
			$this->db->where('id_booking', $idvaluebooking);
			$this->db->update('bookings');

			$this->session->set_flashdata('newnotif',$cek['kode_booking']);
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Berhasil</b>, booking telah dikonfirmasi!</span></li>');
			redirect('admin');
			return false;
		}else{
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Konfirmasi booking <b>tidak benar</b>!</span></li>');
			redirect('admin');
			return false;
		}
	}

	public function ajaxprosesbooking($id)
	{
		date_default_timezone_set('Asia/Jakarta');
		$idvaluebooking=htmlspecialchars($id);
		$tglhariini=date('Y-m-d');
		$cek=$this->db->get_where('bookings',['id_booking'=>$idvaluebooking])->row_array();
		if($cek['status_booking']=='dikonfirmasi'){
			if($tglhariini>=$cek['tanggal_awal']){
				$this->db->set('notifikasi_booking', 'dibaca');
				$this->db->set('status_booking', 'dalam proses');
				$this->db->where('id_booking', $idvaluebooking);
				$this->db->update('bookings');
				
				$this->session->set_flashdata('newnotif',$cek['kode_booking']);
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Berhasil</b>, booking telah diproses!</span></li>');
				redirect('admin');
				return false;
			}else{
				$this->session->set_flashdata('newnotif',$cek['kode_booking']);
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Proses booking hanya bisa dilakukan pada <b>hari H</b>!</span></li>');
				redirect('admin');
				return false;
			}
		}else{
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Proses booking <b>tidak benar</b>!</span></li>');
			redirect('admin');
			return false;
		}
	}

	public function ajaxtutupbooking($id)
	{
		$idvaluebooking=htmlspecialchars($id);
		$cek=$this->db->get_where('bookings',['id_booking'=>$idvaluebooking])->row_array();
		if($cek['status_booking']=='dalam proses'){
			$this->db->set('notifikasi_booking', 'dibaca');
			$this->db->set('status_booking', 'selesai');
			$this->db->where('id_booking', $idvaluebooking);
			$this->db->update('bookings');
			
			$this->session->set_flashdata('newnotif',$cek['kode_booking']);
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Berhasil</b>, booking telah diselesaikan!</span></li>');
			redirect('admin');
			return false;
		}else{
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Selesai booking <b>tidak benar</b>!</span></li>');
			redirect('admin');
			return false;
		}
	}

	public function ajaxupdatecancel($id)
	{
		$idvaluebooking=htmlspecialchars($id);
		$cek=$this->db->get_where('bookings',['id_booking'=>$idvaluebooking])->row_array();
		if($cek['status_booking']=='cancel'){
			$this->db->set('notifikasi_booking', 'dibaca');
			$this->db->where('id_booking', $idvaluebooking);
			$this->db->update('bookings');
			
			$this->session->set_flashdata('newnotif',$cek['kode_booking']);
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Berhasil</b>, cancel telah dilihat!</span></li>');
			redirect('admin');
			return false;
		}else{
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Cancel booking <b>tidak benar</b>!</span></li>');
			redirect('admin');
			return false;
		}
	}

	public function jsondetailbooking()
	{
		$idnotifbooking=htmlspecialchars($this->input->post('idnotifbooking',true));
		$datajson=$this->db->get_where('bookings',['id_booking'=>$idnotifbooking])->row_array();
		echo json_encode($datajson);
	}

	public function viewallbooking()
	{
		$querybooking="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` JOIN `members` ON `bookings`.`member_id`=`members`.`id_member` ORDER BY `id_booking` DESC";
		$data['viewbookingadmin']=$this->db->query($querybooking)->result_array();
		$this->load->view('viewajax/viewallbooking',$data);
		$this->load->view('templates/footer');
	}

	public function ajaxdetailpesananuser()
	{
		sleep(2);
		$idbooking=htmlspecialchars($this->input->post('idbooking',true));
		$querybooking="SELECT *, count(`member_idstar`)as count FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` JOIN `members` ON `bookings`.`member_id`=`members`.`id_member` left join `stars` ON `members`.`id_member`=`stars`.`member_idstar` WHERE `id_booking`=$idbooking";
		$datajson=$this->db->query($querybooking)->row_array();
		echo json_encode($datajson);
	}

	public function uploadgaleri()
	{
		$deskripsigaleri=htmlspecialchars(strtolower($this->input->post('deskripsigaleri',true)));
		$pilihmember=htmlspecialchars($this->input->post('pilihmember',true));

		$deskripsinull=trim($deskripsigaleri);
	    if(empty($deskripsinull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Deskripsi</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/index');
			return false;
	    }else{
	      $deskripsibaru = preg_replace('/\s+/', ' ', $deskripsinull);
	    }

	    $pilihmembernull=trim($pilihmember);
	    if(empty($pilihmembernull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Member terkait</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/index');
			return false;
	    }else{
	      $pilihmemberbaru = preg_replace('/\s+/', ' ', $pilihmembernull);
	    }

		if($_FILES['fotogaleri']['name']){
			if($_FILES['fotogaleri']['size']==''||$_FILES['fotogaleri']['size']>2048000){
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Ukuran gambar terlalu besar <b>max 2MB</b>!</span></li>');
				redirect('users/index');
				return false;
			}else{
				$config['upload_path']          = './assets/img/galery/';
	            $config['allowed_types']        = 'gif|jpg|png';
	            $config['max_size']             = 2048;

	            $this->load->library('upload', $config);

	            if($this->upload->do_upload('fotogaleri')){
	            	$foto=$this->upload->data('file_name');
	            }else{
	            	$error = $this->upload->display_errors('','');
	            	if($error=='The filetype you are attempting to upload is not allowed.'){
	            		$errors=['error'=>'Format file harus JPG,GIF,PNG'];
	            		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Format file harus <b>JPG,GIF,PNG</b>!</span></li>');
						redirect('users/index');
						return false;
	            	}else{
	            		$errors=['error'=>'Max gambar 2MB'];
	            		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Ukuran gambar terlalu besar <b>max 2MB</b>!</span></li>');
						redirect('users/index');
						return false;
	            	}
	            }

				$data = array(
				        'id_galeri' => null,
				        'id_membergaleri' => $pilihmemberbaru,
				        'foto_galeri' => $foto,
				        'deskripsi_galeri' => $deskripsibaru,
				        'tanggal_upload' => time()
						);
				$this->db->insert('galeris', $data);
				$idtambah = $this->db->insert_id();

				// $errors=['error'=>'success'];
			 //    echo json_encode($errors);
				$this->session->set_flashdata('newnotiftambah',$idtambah);
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Foto galeri berhasil <b>ditambahkan</b>!</span></li>');
				redirect('users/index');
				return false;
			}
		}else{
			// echo "tidak ada foto";
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Foto tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/index');
			return false;
		}
		
	}

	public function editgaleriinfo()
	{
		$idgaleri=htmlspecialchars($this->input->post('idgaleri',true));
		$query="SELECT * FROM `galeris` JOIN `members` ON `galeris`.`id_membergaleri`=`members`.`id_member` WHERE `id_galeri`=$idgaleri";
		$datajson=$this->db->query($query)->row_array();
		echo json_encode($datajson);
	}

	public function editgaleri()
	{
		$deskripsigaleriedit=htmlspecialchars(strtolower($this->input->post('deskripsigaleriedit',true)));
		$pilihmemberedit=htmlspecialchars($this->input->post('pilihmemberedit',true));
		$idgalerilama=htmlspecialchars($this->input->post('editgalerilama',true));
		$fotopertama=$this->db->get_where('galeris',['id_galeri'=>$idgalerilama])->row_array();
		// var_dump($pilihmemberedit);die;
		$deskripsinull=trim($deskripsigaleriedit);
	    if(empty($deskripsinull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Deskripsi</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/index');
			return false;
	    }else{
	      $deskripsieditbaru = preg_replace('/\s+/', ' ', $deskripsinull);
	    }

	    $pilihmembernull=trim($pilihmemberedit);
	    if(empty($pilihmembernull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Member terkait</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/index');
			return false;
	    }else{
	      $pilihmembereditbaru = preg_replace('/\s+/', ' ', $pilihmembernull);
	    }

		if($_FILES['fotogaleriedit']['name']){
			if($_FILES['fotogaleriedit']['size']==''||$_FILES['fotogaleriedit']['size']>2048000){
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Ukuran gambar terlalu besar <b>max 2MB</b>!</span></li>');
				redirect('users/index');
				return false;
			}else{
				$config['upload_path']          = './assets/img/galery/';
	            $config['allowed_types']        = 'gif|jpg|png';
	            $config['max_size']             = 2048;

	            $this->load->library('upload', $config);

	            if($this->upload->do_upload('fotogaleriedit')){
	            	unlink(FCPATH . '/assets/img/galery/' .$fotopertama['foto_galeri']);
	            	$foto=$this->upload->data('file_name');
	            }else{
	            	$error = $this->upload->display_errors('','');
	            	if($error=='The filetype you are attempting to upload is not allowed.'){
	            		$errors=['error'=>'Format file harus JPG,GIF,PNG'];
	            		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Format file harus <b>JPG,GIF,PNG</b>!</span></li>');
						redirect('users/index');
						return false;
	            	}else{
	            		$errors=['error'=>'Max gambar 2MB'];
	            		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Ukuran gambar terlalu besar <b>max 2MB</b>!</span></li>');
						redirect('users/index');
						return false;
	            	}
	            	// echo json_encode($errors);
	         //    	redirect('users');
	      			// return false;
	            }
			}
		}else{
			$foto=$fotopertama['foto_galeri'];
		}

		$this->db->set('id_membergaleri', $pilihmembereditbaru);
		$this->db->set('foto_galeri', $foto);
		$this->db->set('deskripsi_galeri', $deskripsieditbaru);
		$this->db->where('id_galeri', $idgalerilama);
		$this->db->update('galeris');

		// $errors=['error'=>'success'];
	 //    echo json_encode($errors);
		$this->session->set_flashdata('newnotif',$idgalerilama);
		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Galeri berhasil <b>diedit</b>!</span></li>');
		redirect('users/index');
		return false;
	}

	public function hapusgalerifoto($id)
	{
		$idgaleri=htmlspecialchars($id);
		$fotolama=$this->db->get_where('galeris',['id_galeri'=>$idgaleri])->row_array();
		unlink(FCPATH . '/assets/img/galery/' .$fotolama['foto_galeri']);
		$this->db->where('id_galeri', $idgaleri);
		$this->db->delete('galeris');
		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Foto galeri berhasil <b>dihapus</b>!</span></li>');
		redirect('users/index');
		return false;
	}

	public function tambahmember()
	{
		$namamember=htmlspecialchars(strtolower($this->input->post('namamember',true)));
		$alamatmember=htmlspecialchars(strtolower($this->input->post('alamatmember',true)));
		$tlpmember=htmlspecialchars(strtolower($this->input->post('tlpmember',true)));
		$kelaminmember=htmlspecialchars(strtolower($this->input->post('kelaminmember',true)));
		$lahirmember=htmlspecialchars(strtolower($this->input->post('lahirmember',true)));
		$bidangmember=htmlspecialchars(strtolower($this->input->post('bidangmember',true)));
		$hargamember=htmlspecialchars(strtolower($this->input->post('hargamembers',true)));
		$emailmember=htmlspecialchars(strtolower($this->input->post('emailmember',true)));

		$namanull=trim($namamember);
	    if(empty($namanull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Nama</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $namabaru = preg_replace('/\s+/', ' ', $namanull);
	    }
	    $alamatnull=trim($alamatmember);
	    if(empty($alamatnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Alamat</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $alamatbaru = preg_replace('/\s+/', ' ', $alamatnull);
	    }
	    $tlpnull=trim($tlpmember);
	    if(empty($tlpnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>No.telepon</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $tlpbaru = preg_replace('/\s+/', ' ', $tlpnull);
	    }
	    $kelaminnull=trim($kelaminmember);
	    if(empty($kelaminnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Jenis kelamin</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $kelaminbaru = preg_replace('/\s+/', ' ', $kelaminnull);
	    }
	    $lahirnull=trim($lahirmember);
	    if(empty($lahirnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Tanggal lahir</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $lahirbaru = preg_replace('/\s+/', ' ', $lahirnull);
	    }
	    $bidangnull=trim($bidangmember);
	    if(empty($bidangnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Bidang/keahlian</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $bidangbaru = preg_replace('/\s+/', ' ', $bidangnull);
	    }
	    $harganull=trim($hargamember);
	    if(empty($harganull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Harga</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $hargabaru = preg_replace('/\s+/', ' ', $harganull);
	    }
	    $emailnull=trim($emailmember);
	    if(empty($emailnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Email</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $emailbaru = preg_replace('/\s+/', ' ', $emailnull);
	    }

	    if($_FILES['fotomember']['name']){
			if($_FILES['fotomember']['size']==''||$_FILES['fotomember']['size']>2048000){
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Ukuran gambar terlalu besar <b>max 2MB</b>!</span></li>');
				redirect('users/pemesanan');
				return false;
			}else{
				$config['upload_path']          = './assets/img/anggota/';
	            $config['allowed_types']        = 'gif|jpg|png';
	            $config['max_size']             = 2048;

	            $this->load->library('upload', $config);

	            if($this->upload->do_upload('fotomember')){
	            	$foto=$this->upload->data('file_name');
	            }else{
	            	$error = $this->upload->display_errors('','');
	            	if($error=='The filetype you are attempting to upload is not allowed.'){
	            		$errors=['error'=>'Format file harus JPG,GIF,PNG'];
	            		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Format file harus <b>JPG,GIF,PNG</b>!</span></li>');
						redirect('users/pemesanan');
						return false;
	            	}else{
	            		$errors=['error'=>'Max gambar 2MB'];
	            		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Ukuran gambar terlalu besar <b>max 2MB</b>!</span></li>');
						redirect('users/pemesanan');
						return false;
	            	}
	            	// redirect('users/pemesanan');
	            	// return false;
	            }
	            $gabung=time();
				$data = array(
				        'id_member' => null,
				        'foto_member' => $foto,
				        'nama_member' => $namabaru,
				        'alamat_member' => $alamatbaru,
				        'nomertelepon_member' => $tlpbaru,
				        'jeniskelamin_member' => $kelaminbaru,
				        'tanggallahir_member' => $lahirbaru,
				        'bidang_member' => $bidangbaru,
				        'harga_member' => $hargabaru,
				        'tanggalgabung_member' => $gabung,
				        'email_member' => $emailbaru,
				        'status_member' => 'aktif'
						);

				$this->db->insert('members', $data);
				$idtambah = $this->db->insert_id();
				
				$this->session->set_flashdata('newnotiftambah',$idtambah);
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Member berhasil <b>ditambah</b>!</span></li>');
				redirect('users/pemesanan');
				return false;
			}
		}else{
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Foto tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
		}

	}

	public function editdatamember()
	{
		$namamemberedit=htmlspecialchars(strtolower($this->input->post('namamemberedit',true)));
		$alamatmemberedit=htmlspecialchars(strtolower($this->input->post('alamatmemberedit',true)));
		$tlpmemberedit=htmlspecialchars(strtolower($this->input->post('tlpmemberedit',true)));
		$kelaminmemberedit=htmlspecialchars(strtolower($this->input->post('kelaminmemberedit',true)));
		$lahirmemberedit=htmlspecialchars(strtolower($this->input->post('lahirmemberedit',true)));
		$bidangmemberedit=htmlspecialchars(strtolower($this->input->post('bidangmemberedit',true)));
		$hargamemberedit=htmlspecialchars(strtolower($this->input->post('hargamemberedit',true)));
		$emailmemberedit=htmlspecialchars(strtolower($this->input->post('emailmemberedit',true)));
		$statusmemberedit=htmlspecialchars(strtolower($this->input->post('statusmemberedit',true)));
		$idmemberlama=htmlspecialchars(strtolower($this->input->post('idmemberlama',true)));
		$fotomemberlama=$this->db->get_where('members',['id_member'=>$idmemberlama])->row_array();
		// var_dump($fotomemberlama['foto_member']);die;
		
		$namanull=trim($namamemberedit);
	    if(empty($namanull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Nama</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $namabaru = preg_replace('/\s+/', ' ', $namanull);
	    }
	    $alamatnull=trim($alamatmemberedit);
	    if(empty($alamatnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Alamat</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $alamatbaru = preg_replace('/\s+/', ' ', $alamatnull);
	    }
	    $tlpnull=trim($tlpmemberedit);
	    if(empty($tlpnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>No.telepon</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $tlpbaru = preg_replace('/\s+/', ' ', $tlpnull);
	    }
	    $kelaminnull=trim($kelaminmemberedit);
	    if(empty($kelaminnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Jenis kelamin</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $kelaminbaru = preg_replace('/\s+/', ' ', $kelaminnull);
	    }
	    $lahirnull=trim($lahirmemberedit);
	    if(empty($lahirnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Tanggal lahir</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $lahirbaru = preg_replace('/\s+/', ' ', $lahirnull);
	    }
	    $bidangnull=trim($bidangmemberedit);
	    if(empty($bidangnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Bidang/keahlian</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $bidangbaru = preg_replace('/\s+/', ' ', $bidangnull);
	    }
	    $harganull=trim($hargamemberedit);
	    if(empty($harganull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Harga</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $hargabaru = preg_replace('/\s+/', ' ', $harganull);
	    }
	    $emailnull=trim($emailmemberedit);
	    if(empty($emailnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Email</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $emailbaru = preg_replace('/\s+/', ' ', $emailnull);
	    }
	    $statusnull=trim($statusmemberedit);
	    if(empty($statusnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Status</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $statusbaru = preg_replace('/\s+/', ' ', $statusnull);
	    }

	    if($_FILES['fotomemberedit']['name']){
			if($_FILES['fotomemberedit']['size']==''||$_FILES['fotomemberedit']['size']>2048000){
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Ukuran gambar terlalu besar <b>max 2MB</b>!</span></li>');
				redirect('users/pemesanan');
				return false;
			}else{
				$config['upload_path']          = './assets/img/anggota/';
	            $config['allowed_types']        = 'gif|jpg|png';
	            $config['max_size']             = 2048;

	            $this->load->library('upload', $config);

	            if($this->upload->do_upload('fotomemberedit')){
	            	unlink(FCPATH . '/assets/img/anggota/' .$fotomemberlama['foto_member']);
	            	$foto=$this->upload->data('file_name');
	            }else{
	            	$error = $this->upload->display_errors('','');
	            	if($error=='The filetype you are attempting to upload is not allowed.'){
	            		$errors=['error'=>'Format file harus JPG,GIF,PNG'];
	            		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Format file harus <b>JPG,GIF,PNG</b>!</span></li>');
						redirect('users/pemesanan');
						return false;
	            	}else{
	            		$errors=['error'=>'Max gambar 2MB'];
	            		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Ukuran gambar terlalu besar <b>max 2MB</b>!</span></li>');
						redirect('users/pemesanan');
						return false;
	            	}
	            	// echo json_encode($errors);
	         //    	redirect('users/pemesanan');
	      			// return false;
	            }
			}
		}else{
			$foto=$fotomemberlama['foto_member'];
		}

		$this->db->set('foto_member', $foto);
		$this->db->set('nama_member', $namabaru);
		$this->db->set('alamat_member', $alamatbaru);
		$this->db->set('nomertelepon_member', $tlpbaru);
		$this->db->set('jeniskelamin_member', $kelaminbaru);
		$this->db->set('tanggallahir_member', $lahirbaru);
		$this->db->set('bidang_member', $bidangbaru);
		$this->db->set('harga_member', $hargabaru);
		$this->db->set('email_member', $emailbaru);
		$this->db->set('status_member', $statusbaru);
		$this->db->where('id_member', $idmemberlama);
		$this->db->update('members');

		$this->session->set_flashdata('newnotif',$idmemberlama);
		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Member berhasil <b>diedit</b>!</span></li>');
		redirect('users/pemesanan');
		return false;

	}

	public function hapusmember($idmember)
	{
		$idmemberbaru=htmlspecialchars($idmember);
		$cekgaleri=$this->db->get_where('galeris',['id_membergaleri'=>$idmemberbaru])->result_array();
		$cekbooking=$this->db->get_where('bookings',['member_id'=>$idmemberbaru])->result_array();
		if($cekbooking){
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Tidak dapat dihapus</b> karena member sudah memiliki riwayat <b>booking</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
		}
		if($cekgaleri){
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Tidak dapat dihapus</b> karena member masih terkait pada <b>galeri foto</b>!</span></li>');
			redirect('users/pemesanan');
			return false;
		}
			$this->db->delete('stars',['member_idstar' => $idmemberbaru]);
			$this->db->delete('members',['id_member' => $idmemberbaru]);
			// echo "asu";
			redirect('users/pemesanan');
		
	}




}