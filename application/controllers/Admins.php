<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Product');
		$this->load->model('Category');
	}

    public function index(){
        redirect('/dashboard/products');
    }

    public function products_dashboard(){
        // $this->output->enable_profiler(TRUE);
        if(!$this->session->userdata('is_admin')){
            redirect('/users/login');
        }
        $data['products'] = $this->Product->get_all();

        $this->load->view('/partials/header');
        $this->load->view('/admins/dashboard_products', $data);
    }

    public function load_products(){
        $data['page_number'] = ($this->input->post('page_number', TRUE) ? $this->input->post('page_number', TRUE) : 1);
        $search_keyword = $this->input->post('search_keyword', TRUE);
        $data['products'] = $this->Product->get_by_name_or_id($search_keyword);
        $response['products'] = $this->load->view('/partials/admins/dashboard_products', $data, TRUE);
        $response['pages'] = $this->load->view('/partials/admins/dashboard_products_footer', $data, TRUE);
        echo json_encode($response);
    }

    public function change_page(){
        echo $tthis->input->post(NULL, TRUE);
        // $this->session->set_flashdata('page_number', );
    }

    public function orders_dashboard(){
        $this->load->view('/partials/header');
        $this->load->view('/admins/dashboard_orders');
    }

    public function orders_show($order_id){
        $this->load->view('/partials/header');
        $this->load->view('/admins/order_details');
    }
    
}
