<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('User');
	}

	public function login(){
		if($this->session->userdata('user_id') != null){
			redirect('/');
		}
		$this->load->view('/partials/header');
		$this->load->view('/users/login_page');
	}

	public function login_process(){
		$form_data = $this->input->post(NULL, TRUE);
		$result = $this->User->verify($form_data);
		if($result === 'success'){
			redirect('/');
		}else{
			$this->session->set_flashdata('error_message', $result);
			redirect('/users/login');
		}
	}

	public function register(){
		if($this->session->userdata('user_id') != null){
			redirect('/');
		}
		
		$this->load->view('/partials/header');
		$this->load->view('/users/registration_page');
	}

	public function registration_process(){
		$form_data = $this->input->post(NULL, TRUE);
		$result = $this->User->validate($form_data);
		if($result === 'success'){
			$this->User->create($form_data);
			redirect('/users/login');
		}else{
			$this->session->set_flashdata('error_message', $result);
			redirect('/users/register');
		}
	}

	public function logoff(){
		$this->session->sess_destroy();
		redirect('/users/login');
	}

	public function profile(){
		$this->load->view('/partials/header');
		$this->load->view('/users/edit_profile');
	}
	
    public function carts(){
		$this->load->view('/partials/header');
        $this->load->view('/users/cart_page.php');
    }

	public function history(){
		$this->load->view('/partials/header');
        $this->load->view('/users/order_history.php');
	}

}
