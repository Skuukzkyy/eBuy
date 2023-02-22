<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('User');
		$this->load->model('Cart');
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
		$data['cart_count']  = $this->Cart->count();
		
		$this->load->view('/partials/header', $data);
		$this->load->view('/users/edit_profile');
	}
	
    public function carts(){
		$data['cart_count']  = $this->Cart->count();
		$this->load->view('/partials/header', $data);
        $this->load->view('/users/cart_page');
    }

	public function update_cart_quantity(){
		$form_data = $this->input->post(NULL, TRUE);
		var_dump($form_data);
		$result = $this->Cart->validate();
		if($result == 'success'){
			$this->Cart->update_quantity($this->session->userdata('user_id'), $form_data);
		}
	}

	public function delete_cart_item($product_id){
		$this->Cart->delete_item($product_id, $this->session->userdata('user_id'));
		echo $product_id;
	}

	public function load_cart_items(){
		$data['cart_items'] = $this->Cart->get_all($this->session->userdata('user_id'));
        $this->load->view('/partials/products_page/cart_items', $data);
	}

	public function history(){
		$data['cart_count']  = $this->Cart->count();
		$this->load->view('/partials/header', $data);
        $this->load->view('/users/order_history.php');
	}

	public function update_header(){
		$data['cart_count']  = $this->Cart->count();
		$this->load->view('/partials/header', $data);
	}

}
