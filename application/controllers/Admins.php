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
        $data['categories'] = $this->Category->get_all();

        $this->load->view('/partials/header');
        $this->load->view('/admins/dashboard_products', $data);
    }

    public function load_products(){
        $data['page_number'] = $this->input->post('page_number', TRUE);
        $search_keyword = $this->input->post('search_keyword', TRUE);
        $data['products'] = $this->Product->get_by_name_or_id($search_keyword);
        $response['products'] = $this->load->view('/partials/admins/dashboard_products', $data, TRUE);
        $response['pages'] = $this->load->view('/partials/admins/dashboard_products_footer', $data, TRUE);
        echo json_encode($response);
    }

    public function update_category(){
        $form_data = $this->input->post(NULL, TRUE);
        $this->Category->update($form_data);
    }

    public function create(){
        $form_data = $this->input->post(NULL, TRUE);
        $result = $this->Product->validate_create();
        if($result == 'success'){

            $is_existing_category = $this->Category->get_by_id($form_data['category']);
            if(!$is_existing_category){
                $form_data['category'] = $this->Category->create($form_data['category']);
            }
            // validate uploaded image extensions
            $uploaded_images = $_FILES['images'];
            $result = $this->is_valid_image($uploaded_images);
            if($result === TRUE){
                // get the max id in the product table so that I know the id of this product will be and create directory for it
                $product_id = $this->Product->get_max_id()['max_id'] + 1;
                $upload_path = "D:/village88/Capstone/ebuy/assets/img/products/$product_id";
                // create directory if not exist
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 7777, TRUE);
                }
                // loop through sa lahat ng laman to move image to the product folder
                for ($i = 0; $i < count($uploaded_images['name']); $i++) { 
                    $image_name = $uploaded_images['name'][$i];
                    $image_tmp = $uploaded_images['tmp_name'][$i];
                    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                    move_uploaded_file($image_tmp, "$upload_path/$image_name");
                }
                $image_names = $uploaded_images['name'];
                $image_json = array(
                    'main' => array_shift($image_names),
                    'others' => $image_names //array shift removes the first element in the array (which is the main image)
                );
                $image_json =  json_encode($image_json);
                $form_data['images'] = $image_json;
                // add to database
                $this->Product->create($form_data);
                $this->session->set_flashdata('success_message', "Added new product successfully");
                redirect('/dashboard/products');
            }else{
                $this->session->set_flashdata('error_message', $result);
                redirect('/dashboard/products');
            }
        }else{
            $this->session->set_flashdata('error_message', $result);
            redirect('/dashboard/products');
        }
    }

    public function orders_dashboard(){
        $this->load->view('/partials/header');
        $this->load->view('/admins/dashboard_orders');
    }

    public function orders_show($order_id){
        $this->load->view('/partials/header');
        $this->load->view('/admins/order_details');
    }

    public function is_valid_image($uploaded_images){
        // Check uploaded images count (limit 4)
        if(count($uploaded_images['name']) > 4){
            return "You can only add 4 images";
        }

        $image_types = $uploaded_images['type'];
        $valid_types = array('image/png', 'image/jpeg', 'image/jpg');
        foreach ($image_types as $image_type){
            if(!in_array($image_type, $valid_types)){
                return "Unsupported file type $image_type";
            }
        }
        return TRUE;
    }

    // public function test(){
    //     echo "<pre>";
    //     echo $this->input->get('category_id');
    //     echo "</pre>";
    // }
}