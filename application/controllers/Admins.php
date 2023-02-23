<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Product');
		$this->load->model('Category');
		$this->load->model('Order');
		$this->load->model('Cart');
	}

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

    public function load_products(){
        $data['categories'] = $this->Category->get_all();
        $data['page_number'] = $this->input->post('page_number', TRUE);
        $search_keyword = $this->input->post('search_keyword', TRUE);
        $data['products'] = $this->Product->get_by_name_or_id($search_keyword);
        $response['products'] = $this->load->view('/partials/admins/products', $data, TRUE);
        $response['pages'] = $this->load->view('/partials/admins/products_footer', $data, TRUE);
        $response['categories'] = $this->load->view('/partials/admins/categories', $data, TRUE);
        echo json_encode($response);
    }

    public function load_product_details($product_id){
        $data['categories'] = $this->Category->get_all();
        $data['product_details'] = $this->Product->get_by_id($product_id);
        $response['product_details'] = $this->load->view('/partials/admins/product_details', $data, TRUE);
        $response['categories'] = $this->load->view('/partials/admins/categories', $data, TRUE);
        echo json_encode($response);
    }

    public function update_category(){
        $form_data = $this->input->get(NULL, TRUE);
        $this->Category->update($form_data);
    }

    public function update_product(){
        $form_data = $this->input->post();
        $result = $this->Product->validate();
        if($result === 'success'){
            if(empty($form_data['main'])){
                $this->session->set_flashdata('error_message', "Please choose main Image");
                redirect('/dashboard/products');
                die();
            }
            // if new categfory gawa bago
            $is_existing_category = $this->Category->get_by_id($form_data['category']);
            if(!$is_existing_category){
                $form_data['category'] = $this->Category->create($form_data['category']);
            }

            // delete all other images in the directory
            $upload_path = "D:/village88/Capstone/ebuy/assets/img/products/$form_data[product_id]";
            var_dump($upload_path);
            $directory_files = array_diff(scandir($upload_path), array('.', '..'));
            foreach($directory_files as $file){
                if(!in_array($file, $form_data['new_images'])){
                    unlink("$upload_path/$file");
                }
                echo "<br>";
            }

            var_dump($form_data);
            $main_image_key = array_search($form_data['main'], $form_data['new_images']);
            unset($form_data['new_images'][$main_image_key]);
            $images = array(
                'main' => $form_data['main'],
                'others' => $form_data['new_images']
            );
            $form_data['images'] = json_encode($images);
            $this->Product->update($form_data);
            $this->session->set_flashdata('success_message', 'Product Updated Successfully');

            redirect('/dashboard/products');
        }else{
            $this->session->set_flashdata('error_message', $result);
            redirect('/dashboard/products');
        }
    }

    public function update_product_image($product_id){
        $uploaded_images = $_FILES['images'];
        // var_dump($uploaded_images);die();
        $result = $this->is_valid_image($uploaded_images);
        // echo $result;
        if($result === TRUE){
            $upload_path = "D:/village88/Capstone/ebuy/assets/img/products/$product_id";
            for ($i = 0; $i < count($uploaded_images['name']); $i++) { 
                $image_name = $uploaded_images['name'][$i];
                $image_tmp = $uploaded_images['tmp_name'][$i];
                $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                move_uploaded_file($image_tmp, "$upload_path/$image_name");
            }
            $image_names = $uploaded_images['name'];
            $image_names = array('names' => $image_names);
            echo json_encode($image_names);
        }else{
            // pag sobra sa 4 or invalid file type
        }
    }

    public function show_preview(){
        $data['product_details'] = $this->session->userdata('form_data');
        $this->load->view('/admins/add_preview', $data);
    }

    public function add_preview(){
        $form_data = $this->input->post(NULL, TRUE);
        $this->session->set_userdata('form_data', $form_data);
    }

    public function create(){
        $form_data = $this->input->post(NULL, TRUE);
        var_dump($form_data);
        var_dump($_FILES);
        $result = $this->Product->validate();
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
                var_dump($upload_path);
                if (is_dir($upload_path) == false) {
                    echo "pols";
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

    public function delete_product($product_id){
        $this->Product->delete($product_id);
        $upload_path = "D:/village88/Capstone/ebuy/assets/img/products/$product_id";
        array_map('unlink', glob("$upload_path/*.*"));
        rmdir($upload_path);
    }

    public function delete_category($category_id){
        $this->Category->delete($category_id);
        echo $category_id;
    }

    public function orders_dashboard(){
        $data['orders'] = $this->Order->get_all();
        $this->load->view('/partials/header');
        $this->load->view('/admins/dashboard_orders', $data);
    }

    public function orders_show($order_id){
		$data['cart_count']  = $this->Cart->count();
        $data['order_details'] = $this->Order->get_by_id($order_id);
        $this->load->view('/partials/header', $data);
        $this->load->view('/admins/order_details', $data);
    }

    public function update_order_status(){
        $status = $this->input->get('status', TRUE);
        $order_id = $this->input->get('order_id', TRUE);
        $this->Order->update_order_status($order_id, $status);
    }

    public function filter_order(){
        // $this->output->enable_profiler(TRUE);
        $status = $this->input->get('status', TRUE);
        $search_keyword = $this->input->get('search_keyword', TRUE);
        $data['page_number'] = $this->input->get('page_number', TRUE);
        // echo $this->input->get('page_number', TRUE);
        $data['orders'] = $this->Order->search($search_keyword, $status);
        // var_dump($data['orders']);
        $response['orders'] = $this->load->view('/partials/admins/orders', $data, TRUE);
        $response['footer'] = $this->load->view('/partials/admins/orders_footer', $data, TRUE);
        echo json_encode($response);
    }

    public function is_valid_image($uploaded_images){
        // Check uploaded images count (limit 4)
        if(count($uploaded_images['name']) > 4){
            return "You can only add 4 images";
        }

        $image_types = $uploaded_images['type'];
        $valid_types = array('image/png', 'image/jpeg', 'image/jpg', 'image/webp');
        foreach ($image_types as $image_type){
            if(!in_array($image_type, $valid_types)){
                return "Unsupported file type $image_type";
            }
        }
        return TRUE;
    }

    // public function test(){
    //     echo "<pre>";
    //         echo 123;
    //     echo "</pre>";
    // }
}