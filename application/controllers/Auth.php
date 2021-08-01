<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata('level_user')){
			redirect('users');
		}
		$this->form_validation->set_rules('email','Email','trim|required|valid_email',
			[
				'required'=>'Email harus diisi',
				'valid_email'=>'Email tidak valid'
			]);
		$this->form_validation->set_rules('password','Password','trim|required',['required'=>'Password harus diisi']);
		if ($this->form_validation->run() == FALSE){
			$this->load->view('auth/login');
		}else{
			$this->_login();
		}
	}

	private function _login()
	{
		// unset($_SESSION['awal']);
		// unset($_SESSION['auth']);

		$email=htmlspecialchars(strtolower($this->input->post('email',true)));
		$password=htmlspecialchars($this->input->post('password',true));

		$users=$this->db->get_where('users',['email_user'=>$email,'password_user'=>$password])->row_array();
		if($users){
			// $waktutunggu=30;
			$waktuawal=time();
			if(isset($_SESSION['auth'])){
                $_SESSION['auth']++;
            }else{
                $_SESSION['auth']=1;
            }
			if($_SESSION['auth']>=4){
				if($waktuawal>=$_SESSION['awal']){
					$data=[
						'id_user'=>$users['id_user'],
						'level_user'=>$users['level_user']
					];
					$this->session->set_userdata($data);
					unset($_SESSION['auth']);
					unset($_SESSION['awal']);
					unset($_SESSION['tambah']);
					redirect('users');
				}else{
					// $_SESSION['auth']=4;
					$this->session->set_flashdata('pesan','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;list-style-type:none;"><i class="material-icons right close" style="">close</i><span id="waktutunggu">Anda melewati batas maksimum percobaan login.<br> Harap tunggu <span>'.($_SESSION['awal']-$waktuawal).'</span> detik lagi.</span></li>');
					$this->load->view('auth/login');
					return false;
				}
			}else{
				$data=[
					'id_user'=>$users['id_user'],
					'level_user'=>$users['level_user']
				];
				$this->session->set_userdata($data);
				unset($_SESSION['auth']);
				unset($_SESSION['awal']);
				unset($_SESSION['tambah']);
				redirect('users');
			}
		}else{
			$waktuawal=time();
			if(isset($_SESSION['auth'])){
                $_SESSION['auth']++;
            }else{
                $_SESSION['auth']=1;
            }
            if($_SESSION['auth'] < 4){
				$this->session->set_flashdata('pesan','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;list-style-type:none;"><i class="material-icons right close" style="">close</i><span class="">Email/password salah!</span></li>');
				$this->load->view('auth/login');
				return false;
			}else if($_SESSION['auth'] == 4){
				if(!isset($_SESSION['tambah'])){
					$_SESSION['awal']=(time()+30);
				}else{
					$_SESSION['awal']=(time()+$_SESSION['tambah']);
				}
				$this->session->set_flashdata('pesan','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;list-style-type:none;"><i class="material-icons right close" style="">close</i><span id="waktutunggu">Anda melewati batas maksimum percobaan login.<br> Harap tunggu <span>'.($_SESSION['awal']-$waktuawal).'</span> detik lagi.</span></li>');
				$this->load->view('auth/login');
				return false;
			}else if($_SESSION['auth'] >4 && $waktuawal<=$_SESSION['awal']){
				$this->session->set_flashdata('pesan','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;list-style-type:none;"><i class="material-icons right close" style="">close</i><span id="waktutunggu">Anda melewati batas maksimum percobaan login.<br> Harap tunggu <span>'.($_SESSION['awal']-$waktuawal).'</span> detik lagi.</span></li>');
				$this->load->view('auth/login');
				return false;
			}else if($_SESSION['auth'] >4 && $waktuawal>=$_SESSION['awal']){
				$_SESSION['auth']=1;
				unset($_SESSION['awal']);
				if(!isset($_SESSION['tambah'])){
					$_SESSION['tambah']=30;
					$_SESSION['tambah']=$_SESSION['tambah']+30;
				}else{
					$_SESSION['tambah']=$_SESSION['tambah']+30;
				}
				$this->session->set_flashdata('pesan','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;list-style-type:none;"><i class="material-icons right close" style="">close</i><span class="">Email/password salah!</span></li>');
				$this->load->view('auth/login');
				return false;	
			}
		}
	}

	public function daftar()
	{
		if($this->session->userdata('level_user')){
			redirect('users');
		}
		$this->form_validation->set_rules('namadaftar','Namadaftar','trim|required',
			['required'=>'Nama harus diisi']);
		$this->form_validation->set_rules('tgllahirdaftar','tanggal lahir','trim|required',
			['required'=>'Tanggal lahir harus diisi']);
		$this->form_validation->set_rules('jeniskelamindaftar','Jenis kelamin','trim|required',
			['required'=>'Jenis kelamin harus diisi']);
		$this->form_validation->set_rules('emaildaftar','Email','trim|required|valid_email|is_unique[users.email_user]',
			[
				'required'=>'Email harus diisi',
				'valid_email'=>'Email tidak valid',
				'is_unique'=>'Email sudah terdaftar'
			]);
		$this->form_validation->set_rules('pdaftar1','Password','trim|required|min_length[5]|matches[pdaftar2]',[
				'required'=>'Password harus diisi',
				'min_length'=>'Panjang password min 5 karakter',
				'matches'=>'Confirm password tidak sama'
			]);
		$this->form_validation->set_rules('pdaftar2','confirmpassword','trim|required|matches[pdaftar1]',
			[
				'required'=>'Password harus diisi',
				'matches'=>'Confirm password tidak sama'
			]);

		if ($this->form_validation->run() == FALSE){
			$this->load->view('auth/login');
		}else{
			$data = array(
			        'id_user' => null,
			        'foto_user' => '0.default.png',
			        'nama_user' => htmlspecialchars($this->input->post('namadaftar',true)),
			        'alamat_user' => '',
			        'tanggallahir_user' => htmlspecialchars($this->input->post('tgllahirdaftar',true)),
			        'jeniskelamin_user' => htmlspecialchars($this->input->post('jeniskelamindaftar',true)),
			        'nomertelepon_user' => '',
			        'level_user' => 'user',
			        'tema_user' => 'teal',
			        'email_user' => htmlspecialchars($this->input->post('emaildaftar',true)),
			        'password_user' => htmlspecialchars($this->input->post('pdaftar1',true)),
			        'daftar_user' => time()
					);

			$this->db->insert('users', $data);
			$this->session->set_flashdata('pesan','<li class="collection-item new badge orange lighten-4 hideflash" data-badge-caption="" style="padding:10px 20px 10px 20px;font-weight:500;"><i class="material-icons right close" style="">close</i><span class="">Akun berhasil dibuat <b>silahkan login</b>!</span></li>');
			redirect('auth');
			return false;
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('level_user');
		unset($_SESSION['auth']);
		unset($_SESSION['awal']);
		unset($_SESSION['tambah']);
		redirect('auth');
	}


}