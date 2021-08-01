<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('level_user')){
			redirect('auth');
		}
	}

	public function index()
	{
		$data['title']='beranda';
		$datacarinull=htmlspecialchars($this->input->post('inputcarigaleri',true));
	    $datacarifilter = preg_replace('/\s+/', ' ', trim($datacarinull));

		$querycount="SELECT count(*) as totalcount FROM bookings where notifikasi_booking='belum dibaca'";
		$data['countnotifikasi']=$this->db->query($querycount)->row_array();

		$data['profil']=$this->db->get_where('users',['id_user'=>$this->session->userdata('id_user')])->row_array();

		$query="SELECT * FROM `galeris` JOIN `members` ON `galeris`.`id_membergaleri`=`members`.`id_member` ORDER BY `id_galeri` DESC";
		$data['galeris']=$this->db->query($query)->result_array();

		$querygaleri="SELECT * FROM `galeris` JOIN `members` ON `galeris`.`id_membergaleri`=`members`.`id_member` ORDER BY `id_galeri` DESC limit 5";
		$data['galerislimit']=$this->db->query($querygaleri)->result_array();

		$this->db->order_by('nama_member','asc');
		$data['choses']=$this->db->get('members')->result_array();

		if($datacarifilter){
			$data['valuecari']=$datacarifilter;
			$data['margintop']='50px';
			$query="SELECT * FROM `galeris` JOIN `members` ON `galeris`.`id_membergaleri`=`members`.`id_member` where nama_member like '%$datacarifilter%' or deskripsi_galeri like '%$datacarifilter%' ORDER BY `id_galeri` DESC";
			$data['galeris']=$this->db->query($query)->result_array();
			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('users/home',$data);
			$this->load->view('templates/footer');
		}else{
			$data['valuecari']=$datacarifilter;
			$data['margintop']='0px';
			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/slides',$data);
			$this->load->view('users/home',$data);
			$this->load->view('templates/footer');
		}
	}

	public function pemesanan()
	{
		$data['title']='pemesanan';
		$datacarinull=htmlspecialchars($this->input->post('inputcaridatamember',true));
	    $datacarifilter = preg_replace('/\s+/', ' ', trim($datacarinull));
		$querycount="SELECT count(*) as totalcount FROM bookings where notifikasi_booking='belum dibaca'";
		$data['countnotifikasi']=$this->db->query($querycount)->row_array();
		$data['profil']=$this->db->get_where('users',['id_user'=>$this->session->userdata('id_user')])->row_array();
		$query="SELECT `members`.*,count(`member_idstar`) as `count` FROM `members` LEFT JOIN `stars` ON `members`.`id_member`=`stars`.`member_idstar` GROUP BY `id_member` ORDER BY `count` DESC ";
		$data['members']=$this->db->query($query)->result_array();
		// $data['members']=$this->db->get('members')->result_array();
		$queryc="SELECT * FROM `members` left JOIN `stars` ON `members`.`id_member`=`stars`.`member_idstar` ";
		$data['countc']=$this->db->query($queryc)->result_array();

		if($datacarifilter){
			$data['valuecari']=$datacarifilter;
			$query="SELECT `members`.*,count(`member_idstar`) as `count` FROM `members` LEFT JOIN `stars` ON `members`.`id_member`=`stars`.`member_idstar` WHERE bidang_member like '%$datacarifilter%' or nama_member like '%$datacarifilter%' or `alamat_member` like '%$datacarifilter%' GROUP BY `id_member` ORDER BY `count` DESC ";
			$data['members']=$this->db->query($query)->result_array();

			$queryc="SELECT * FROM `members` left JOIN `stars` ON `members`.`id_member`=`stars`.`member_idstar` WHERE bidang_member like '%$datacarifilter%' or nama_member like '%$datacarifilter%' or `alamat_member` like '%$datacarifilter%'";
			$data['countc']=$this->db->query($queryc)->result_array();

			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('users/pemesanan',$data);
			$this->load->view('templates/footer');
		}else if($datacarifilter==''){
			$data['valuecari']=$datacarifilter;
			$query="SELECT `members`.*,count(`member_idstar`) as `count` FROM `members` LEFT JOIN `stars` ON `members`.`id_member`=`stars`.`member_idstar` GROUP BY `id_member` ORDER BY `count` DESC ";
			$data['members']=$this->db->query($query)->result_array();
			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('users/pemesanan',$data);
			$this->load->view('templates/footer');
		}else{
			$data['valuecari']=$datacarifilter;
			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('users/pemesanan',$data);
			$this->load->view('templates/footer');
		}
	}

	public function daftarpesanan()
	{
		if($this->session->userdata('level_user')!='user'){
			redirect('users');
		}
		date_default_timezone_set('Asia/Jakarta');
		$datacarinull=htmlspecialchars($this->input->post('inputcaridatadaftarpesanan',true));
	    $datacarifilter = preg_replace('/\s+/', ' ', trim($datacarinull));

		$querycount="SELECT count(*) as totalcount FROM bookings where notifikasi_booking='belum dibaca'";
		$data['countnotifikasi']=$this->db->query($querycount)->row_array();
		$iduser=$this->session->userdata('id_user');
		$data['title']='daftar pesanan';
		$data['profil']=$this->db->get_where('users',['id_user'=>$this->session->userdata('id_user')])->row_array();
		$querybooking="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` JOIN `members` ON `bookings`.`member_id`=`members`.`id_member` WHERE `id_user`=$iduser ORDER BY `id_booking` DESC";
		$data['daftarbooking']=$this->db->query($querybooking)->result_array();
			
		if($datacarifilter){
			$data['valuecari']=$datacarifilter;
			// $date = date_create('Y',$datacarifilter);
			// echo $caritanggal=date_timestamp_get($date);die;
			$querybooking="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` JOIN `members` ON `bookings`.`member_id`=`members`.`id_member` WHERE `id_user`=$iduser and (`kode_booking` like '%$datacarifilter%' or `nama_member` like '%$datacarifilter%') ORDER BY `id_booking` DESC";
			$data['daftarbooking']=$this->db->query($querybooking)->result_array();
			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('users/daftarpesanan',$data);
			$this->load->view('templates/footer');
		}else if($datacarifilter==''){
			$data['valuecari']=$datacarifilter;
			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('users/daftarpesanan',$data);
			$this->load->view('templates/footer');
		}else{
			$data['valuecari']=$datacarifilter;
			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('users/daftarpesanan',$data);
			$this->load->view('templates/footer');
		}

	}

	public function uploadbuktipembayaran()
	{
		if($this->session->userdata('level_user')!='user'){
			redirect('users');
		}
		$idpembayaran=htmlspecialchars($this->input->post('idpembayaran',true));
		$fotopertama=$this->db->get_where('bookings',['id_booking'=>$idpembayaran])->row_array();
		if($_FILES['fotopembayaran']['name']){
			if($_FILES['fotopembayaran']['size']==''||$_FILES['fotopembayaran']['size']>2048000){
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Ukuran gambar terlalu besar <b>max 2MB</b>!</span></li>');
				redirect('users/daftarpesanan');
				return false;
			}else{
				$config['upload_path']          = './assets/img/pembayaran/';
	            $config['allowed_types']        = 'gif|jpg|png';
	            $config['max_size']             = 2048;

	            $this->load->library('upload', $config);

	            if($this->upload->do_upload('fotopembayaran')){
	            	if($fotopertama['bukti_pembayaran']==''){
	            		$foto=$this->upload->data('file_name');
	            	}else{
		            	unlink(FCPATH . '/assets/img/pembayaran/' .$fotopertama['bukti_pembayaran']);
		            	$foto=$this->upload->data('file_name');
		            }
	            }else{
	            	$error = $this->upload->display_errors('','');
	            	if($error=='The filetype you are attempting to upload is not allowed.'){
	            		$errors=['error'=>'Format file harus JPG,GIF,PNG'];
	            		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Format file harus <b>JPG,GIF,PNG</b>!</span></li>');
						redirect('users/daftarpesanan');
						return false;
	            	}else{
	            		$errors=['error'=>'Max gambar 2MB'];
	            		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Ukuran gambar terlalu besar <b>max 2MB</b>!</span></li>');
						redirect('users/daftarpesanan');
						return false;
	            	}
	            }
	            $tanggaluploadbukti=time();
				$this->db->set('bukti_pembayaran', $foto);
				$this->db->set('tanggal_pembayaran', $tanggaluploadbukti);
				$this->db->set('notifikasi_pembayaran', 'diupload');
				$this->db->where('id_booking', $idpembayaran);
				$this->db->update('bookings');

				// $errors=['error'=>'success'];
			 //    echo json_encode($errors);
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Bukti pembayaran berhasil <b>diupload</b>!</span></li>');
				redirect('users/daftarpesanan');
				return false;
			}
		}else{
			redirect('users/daftarpesanan');
			return false;
		}

	}

	public function about()
	{
		$data['title']='about';
		$data['profil']=$this->db->get_where('users',['id_user'=>$this->session->userdata('id_user')])->row_array();
		$this->load->view('users/about',$data);
	}

	public function akun()
	{
		$data['title']='informasi akun';
		$data['profil']=$this->db->get_where('users',['id_user'=>$this->session->userdata('id_user')])->row_array();
		$this->load->view('users/akun',$data);
	}

	public function setpassword()
	{
		$data['title']='setting password';
		$data['profil']=$this->db->get_where('users',['id_user'=>$this->session->userdata('id_user')])->row_array();
		$userid=$this->session->userdata('id_user');
		$passwordlama=htmlspecialchars($this->input->post('passwordlama',true));
		$matchpassword=$this->db->get_where('users',['id_user'=>$userid])->row_array();

		$this->form_validation->set_rules('passwordlama','passwordlama','trim|required',
			[
				'required'=>'Password harus diisi'
			]);
		$this->form_validation->set_rules('passwordbaru','Password','trim|required|min_length[5]|matches[passwordconfirm]',[
				'required'=>'Password harus diisi',
				'min_length'=>'Panjang password min 5 karakter',
				'matches'=>'Confirm password tidak sama'
			]);
		$this->form_validation->set_rules('passwordconfirm','confirmpassword','trim|required|matches[passwordbaru]',
			[
				'required'=>'Password harus diisi',
				'matches'=>'Confirm password tidak sama'
			]);

		if ($this->form_validation->run() == FALSE){
			$this->load->view('users/setpassword',$data);
		}else{
			if($matchpassword['password_user']!=$passwordlama){
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="color:black;">close</i><span><b>Gagal</b> passwod lama salah!</span></li>');
				redirect('users/setpassword');
				return false;
			}else{
				$this->db->set('password_user', htmlspecialchars($this->input->post('passwordbaru',true)));
				$this->db->where('id_user', $userid);
				$this->db->update('users');
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="color:black;">close</i><span><b>Success</b> passwod berhasil diubah!</span></li>');
				redirect('users/setpassword');
				return false;
			}
		}
	}

	public function editakun()
	{
		$userid=$this->session->userdata('id_user');
		$namaakun=htmlspecialchars(strtolower($this->input->post('namaakun',true)));
		$tlpakun=htmlspecialchars($this->input->post('tlpakun',true));
		$lahirakun=htmlspecialchars($this->input->post('lahirakun',true));
		$kelaminakun=htmlspecialchars($this->input->post('kelaminakun',true));
		$emailakun=htmlspecialchars(strtolower($this->input->post('emailakun',true)));
		$alamatakun=htmlspecialchars(strtolower($this->input->post('alamatakun',true)));
		$fotouserlama=$this->db->get_where('users',['id_user'=>$userid])->row_array();

		$namanull=trim($namaakun);
	    if(empty($namanull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Nama</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/akun');
			return false;
	    }else{
	      $namabaru = preg_replace('/\s+/', ' ', $namanull);
	    }
	    $tlpnull=trim($tlpakun);
	    if(empty($tlpnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>No.telepon</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/akun');
			return false;
	    }else{
	      $tlpbaru = preg_replace('/\s+/', ' ', $tlpnull);
	    }
	    $lahirnull=trim($lahirakun);
	    if(empty($lahirnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Tanggal lahir</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/akun');
			return false;
	    }else{
	      $lahirbaru = preg_replace('/\s+/', ' ', $lahirnull);
	    }
	    $kelaminnull=trim($kelaminakun);
	    if(empty($kelaminnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Jenis kelamin</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/akun');
			return false;
	    }else{
	      $kelaminbaru = preg_replace('/\s+/', ' ', $kelaminnull);
	    }
	    $alamatnull=trim($alamatakun);
	    if(empty($alamatnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Alamat</b> tidak boleh <b>kosong</b>!</span></li>');
			redirect('users/akun');
			return false;
	    }else{
	      $alamatbaru = preg_replace('/\s+/', ' ', $alamatnull);
	    }

	    if($_FILES['fotoakun']['name']){
			if($_FILES['fotoakun']['size']==''||$_FILES['fotoakun']['size']>2048000){
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Ukuran gambar terlalu besar <b>max 2MB</b>!</span></li>');
				redirect('users/akun');
				return false;
			}else{
				$config['upload_path']          = './assets/img/users/';
	            $config['allowed_types']        = 'gif|jpg|png';
	            $config['max_size']             = 2048;

	            $this->load->library('upload', $config);

	            if($this->upload->do_upload('fotoakun')){
	            	if($fotouserlama['foto_user'] != '0.default.png'){
	            		unlink(FCPATH . '/assets/img/users/' .$fotouserlama['foto_user']);
	            	}
	            	$foto=$this->upload->data('file_name');
					$this->db->set('foto_user', $foto);
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
	            }
			}
		}else{
			$foto=$fotouserlama['foto_user'];
		}

		$this->db->set('nama_user', $namabaru);
		$this->db->set('alamat_user', $alamatbaru);
		$this->db->set('nomertelepon_user', $tlpbaru);
		$this->db->set('jeniskelamin_user', $kelaminbaru);
		$this->db->set('tanggallahir_user', $lahirbaru);
		// $this->db->set('email_user', $emailbaru);
		$this->db->where('id_user', $userid);
		$this->db->update('users');

		$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Informasi akun berhasil <b>diedit</b>!</span></li>');
		redirect('users/akun');
		return false;

	}

	public function ajaxinfoanggota()
	{
		// sleep(2);
		$idmember=htmlspecialchars($this->input->post('idmember',true));
		// $datajson=$this->db->get_where('members',['id_member'=>$idmember])->row_array();
		$query="SELECT `members`.*,count(`member_idstar`) as `count` FROM `members` LEFT JOIN `stars` ON `members`.`id_member`=`stars`.`member_idstar` WHERE `id_member`=$idmember";
		$datajson=$this->db->query($query)->row_array();
		echo json_encode($datajson);
	}

	public function ajaxdetailpesanan()
	{
		if($this->session->userdata('level_user')!='user'){
			redirect('users');
		}
		$idbooking=htmlspecialchars($this->input->post('idbooking',true));
		$querybooking="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` JOIN `members` ON `bookings`.`member_id`=`members`.`id_member` WHERE `id_booking`=$idbooking";
		$datajson=$this->db->query($querybooking)->row_array();
		echo json_encode($datajson);
	}

	public function ajaxtambahstar()
	{
		$userid=$this->session->userdata('id_user');
		$idmember=htmlspecialchars($this->input->post('idstar',true));
		$time=time();
		$cekmember=$this->db->get_where('members',['id_member'=>$idmember])->row_array();
		if($cekmember){
			$cekuserstar=$this->db->get_where('stars',['user_idstar'=>$userid,'member_idstar'=>$idmember])->row_array();
			$idstar=$cekuserstar['id_star'];
			if($cekuserstar){
				$this->db->where('id_star', $idstar);
				$this->db->delete('stars');
				echo "success";
			}else{
				$data = array(
		        'id_star' => null,
		        'user_idstar' => $userid,
		        'member_idstar' => $idmember,
		        'time' => $time
				);
				$this->db->insert('stars', $data);
				echo "success";
			}
		}else{
			echo "memeber tidak ada";
		}
	}

	public function newbooking()
	{
		if($this->session->userdata('level_user')!='user'){
			redirect('users');
			return false;
		}
		date_default_timezone_set('Asia/Jakarta');
		$userid=$this->session->userdata('id_user');
		$memberid=htmlspecialchars($this->input->post('idmember',true));
		$alamatuser=htmlspecialchars(strtolower($this->input->post('alamatuser',true)));
		$teleponuser=htmlspecialchars($this->input->post('teleponuser',true));
		$tanggalbooking=time();
		$tanggalawal=htmlspecialchars($this->input->post('tanggalawal',true));
		$tanggalahir=htmlspecialchars($this->input->post('tanggalahir',true));
		$totalbooking=htmlspecialchars($this->input->post('totalbooking',true));

		$querymax = "SELECT max(kode_booking) as maxKode FROM bookings";
		$datahasil = $this->db->query($querymax)->row_array();
		$kodebooking= $datahasil['maxKode'];
		$noUrut = (int) substr($kodebooking, 2, 9);
		$noUrut++;
		$lc = "LC";
		$newKodeBooking = $lc . sprintf("%04s", $noUrut);

		$cekmember=$this->db->get_where('members',['id_member'=>$memberid])->row_array();

		// var_dump($cekmember);die;

		$start_date = new DateTime($tanggalawal);
		$end_date = new DateTime($tanggalahir);
		$interval = $start_date->diff($end_date);
		$selisih=intval($interval->days)+1;
		$totalbookingb=$selisih*$cekmember['harga_member'];
		if($tanggalawal<=date('Y-m-d')){
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Gagal</b>, harap isi data dengan benar!</span></li>');
			redirect('users/pemesanan');
			return false;
		}

		if($cekmember['status_member']=='tidak aktif'){
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Gagal</b>, harap isi data dengan benar!</span></li>');
			redirect('users/pemesanan');
			return false;
		}

		$alamatnull=trim($alamatuser);
	    if(empty($alamatnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Gagal</b>, harap isi data dengan benar!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $stringbarua = preg_replace('/\s+/', ' ', $alamatnull);
	    }

	    $teleponnull=trim($teleponuser);
	    if(empty($teleponnull)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Gagal</b>, harap isi data dengan benar!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }else{
	      $stringbarut = preg_replace('/\s+/', ' ', $teleponnull);
	    }

	    if(empty($tanggalawal)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Gagal</b>, harap isi data dengan benar!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }

	    if(empty($tanggalahir)){
	      	$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Gagal</b>, harap isi data dengan benar!</span></li>');
			redirect('users/pemesanan');
			return false;
	    }

		if($tanggalawal>$tanggalahir){
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Gagal</b>, harap isi data dengan benar!</span></li>');
			redirect('users/pemesanan');
			return false;
		}else{
			// jika ada yg pesan tidak akan bisa pesan
			$query="SELECT * from bookings where member_id=$memberid and (status_booking='menunggu' or status_booking='dalam proses' or status_booking='dikonfirmasi') and tanggal_awal<='$tanggalahir' and tanggal_ahir>='$tanggalawal'";
			$cekbooking=$this->db->query($query)->result_array();
			if($cekbooking==true){
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Gagal</b>, videografer/fotografer sudah dibooking pada tgl tsb!</span></li>');
				redirect('users/pemesanan');
				return false;
			}else{

				$tanggaluploadbukti=time();
				$data = array(
		        'id_booking' => null,
		        'kode_booking'=>$newKodeBooking,
		        'user_id' => $userid,
		        'member_id' => $memberid,
		        'alamat_booking' => $stringbarua,
		        'nomertelepon_booking' => $stringbarut,
		        'tanggal_booking' => $tanggalbooking,
		        'tanggal_awal' => $tanggalawal,
		        'tanggal_ahir' => $tanggalahir,
		        'harga_booking' => $totalbookingb,
		        'status_booking' => 'menunggu',
		        'notifikasi_booking' => 'belum dibaca',
		        'bukti_pembayaran' => '',
		        'tanggal_pembayaran' => $tanggaluploadbukti,
		        'notifikasi_pembayaran' => 'belum'
				);
				$this->db->insert('bookings', $data);
				$this->session->set_flashdata('newbooking',$newKodeBooking);
				$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Booking</b> success!</span></li>');
				redirect('users/daftarpesanan');
				return false;
			}
		}
	
	}

	public function cekbooking()
	{
		if($this->session->userdata('level_user')!='user'){
			redirect('users');
		}
		date_default_timezone_set('Asia/Jakarta');
		$memberidcek=htmlspecialchars($this->input->post('idmembercek',true));
		$tanggalpertama=htmlspecialchars($this->input->post('tanggalpertama',true));
		$tanggalkedua=htmlspecialchars($this->input->post('tanggalkedua',true));
		$alamatuser=htmlspecialchars(strtolower($this->input->post('alamatuser',true)));
		$teleponuser=htmlspecialchars($this->input->post('teleponuser',true));

		// echo $tanggalkedua;die;

		$cekmember=$this->db->get_where('members',['id_member'=>$memberidcek])->row_array();

		$start_date = new DateTime($tanggalpertama);
		$end_date = new DateTime($tanggalkedua);
		$interval = $start_date->diff($end_date);
		$selisih=intval($interval->days)+1;
		$totalbooking=$selisih*$cekmember['harga_member'];
		if($tanggalpertama <= date('Y-m-d')){
			echo "Harus diatas tanggal sekarang!";
			return false;
		}

		$alamatnull=trim($alamatuser);
	    if(empty($alamatnull)){
	      echo "Alamat tidak boleh kosong!";
	      return false;
	    }else{
	      $stringbarua = preg_replace('/\s+/', ' ', $alamatnull);
	    }

	    $teleponnull=trim($teleponuser);
	    if(empty($teleponnull)){
	      echo "Telepon tidak boleh kosong!";
	      return false;
	    }else{
	      $stringbarut = preg_replace('/\s+/', ' ', $teleponnull);
	    }

		if($tanggalpertama>$tanggalkedua){
			echo "Tanggal AWAL harus lebih kecil dari tanggal AHIR!";
			return false;
		}else{
			// $query="SELECT * from bookings where member_id='$memberidcek' and (status_booking='menunggu' or status_booking='dikonfirmasi' or status_booking='dalam proses') and (tanggal_awal<='$tanggalkedua' and tanggal_ahir>='$tanggalpertama')";
			// $cekbooking=$this->db->query($query)->result_array();
			// if($cekbooking==true){
			// 	echo "gagal";
			// }else{
				echo "ok";
			// }
		}
	}

	public function batalbooking()
	{
		// if($this->session->userdata('level_user')!='user'){
		// 	redirect('users');
		// }
		$iduser=$this->session->userdata('id_user');
		$idbooking=htmlspecialchars($this->input->post('idbooking',true));
		$querybooking="SELECT * FROM `users` LEFT JOIN `bookings` ON `users`.`id_user`=`bookings`.`user_id` JOIN `members` ON `bookings`.`member_id`=`members`.`id_member` WHERE `id_user`=$iduser ORDER BY `id_booking` DESC";
		$data['daftarbooking']=$this->db->query($querybooking)->result_array();
		$cek=$this->db->get_where('bookings',['user_id'=>$iduser,'id_booking'=>$idbooking])->row_array();
		if($cek['status_booking']=='dalam proses'||$cek['status_booking']=='selesai'||$cek['status_booking']=='cancel'){
			echo "tidak bisa dibatalkan";
		}else{
			$this->db->set('status_booking', 'cancel');
			$this->db->set('notifikasi_booking', 'belum dibaca');
			$this->db->where('id_booking', $idbooking);
			$this->db->where('user_id', $iduser);
			$this->db->update('bookings');

			$this->session->set_flashdata('newbooking',$cek['kode_booking']);
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class=""><b>Cancel</b> success!</span></li>');
			// redirect('users/daftarpesanan');
			echo "success";
		}
	}

	public function ubahtema()
	{
		$userid=$this->session->userdata('id_user');
		$valuetheme=htmlspecialchars($this->input->post('valuetheme',true));
		if($valuetheme=='blue'||$valuetheme=='teal'||$valuetheme=='grey darken-4'||$valuetheme=='red'||$valuetheme=='orange'){
			$this->db->set('tema_user', $valuetheme);
			$this->db->where('id_user', $userid);
			$this->db->update('users');
			
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Tema berhasil <b>diubah</b>!</span></li>');
			echo 'success';
		}else{
			$this->session->set_flashdata('message','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Tema <b>tidak valid</b>!</span></li>');
			echo 'success';
		}
	}

	public function allgaleris()
	{
		$query="SELECT * FROM `galeris` JOIN `members` ON `galeris`.`id_galeri`=`members`.`id_member` ORDER BY `id_galeri` DESC";
		$data['galeris']=$this->db->query($query)->result_array();
	}

	public function caridatagaleris()
	{
		$datacari=htmlspecialchars($this->input->post('datacari',true));
		$data['title']='beranda';
		$query="SELECT * FROM `galeris` JOIN `members` ON `galeris`.`id_membergaleri`=`members`.`id_member` where nama_member like '%$datacari%' ORDER BY `id_galeri` DESC";
		$data['galerisa']=$this->db->query($query)->result_array();
		// $this->load->view('templates/header');
		$this->load->view('viewajax/livesearchberanda',$data);
		// $this->load->view('templates/footer');
		// echo json_encode($dataj);
	}


}