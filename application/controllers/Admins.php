<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {

    public function index(){
        redirect('/dashboard/products');
    }

    public function products_dashboard(){
        // $this->output->enable_profiler(TRUE);
        if(!$this->session->userdata('is_admin')){
            redirect('/users/login');
        }

        $this->load->view('/partials/header');
        $this->load->view('/admins/dashboard_products');
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
