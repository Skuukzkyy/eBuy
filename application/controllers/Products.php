<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Product');
		$this->load->model('Category');
		$this->load->model('Cart');
	}

	public function update_header(){
		$data['cart_count']  = $this->Cart->count();
		$this->load->view('/partials/header', $data);
	}

	public function index(){
		if($this->session->userdata('is_admin')){
            redirect('/dashboard/products');
        }
		$data['categories'] = $this->Category->get_category_with_product();
		$data['cart_count']  = $this->Cart->count();

		$this->load->view('/partials/header', $data);
		$this->load->view('/products/products_page', $data);
	}

	public function load_products(){
		// $this->output->enable_profiler(TRUE);
		$order_by = $this->input->post('sorted_by', TRUE);
		$category_id = $this->input->post('category_id', TRUE);
		$search_keyword = $this->input->post('search_keyword', TRUE);
		if($category_id != null){
			$this->session->set_userdata('current_category_id', $category_id);
		}
		$data['page_number'] = $this->input->post('page_number', TRUE);
		$data['products'] = $this->Product->get_by_category($search_keyword, $order_by);

        $this->load->view('/partials/products_page/products', $data);
	}

    public function show($product_id){
		$data['cart_count']  = $this->Cart->count();
		$data['product_details'] = $this->Product->get_by_id($product_id);
		$data['similar_products'] = $this->Product->get_similar_product($data['product_details']['category_id'], $product_id);
		// var_dump($data['similar_products']);
		$this->load->view('/partials/header', $data);
        $this->load->view('/products/product_preview', $data);
    }

	public function add_to_cart(){
		$form_data = $this->input->post(NULL, TRUE);
		$result = $this->Cart->validate();
		if($result == 'success'){
			$this->Cart->add($form_data);
			echo 'success';
		}else{
			echo $result;
		}

	}





	public function test(){
		$this->output->enable_profiler(TRUE);
		$images = [
					'main' => '1.png',
					'others' => [
							'2.png',
							'3.png',
							'4.png',
						]
				];

		$query = "
				INSERT INTO products(category_id, name, description, price, inventory_count, images)
				VALUES (?,?,?,?,?,?);
			";
		$values = array(5, 'White Dress', 'Kulay Puti', 800, 96, json_encode($images));
		// $this->db->query($query, $values);

		$product = $this->db->query("SELECT * FROM products where id = 13")->row_array();
		$product_images = json_decode($product['images']);
		var_dump($product_images->others);
		// echo "<pre>";
		// 	print_r(json_encode($images));
		// echo "</pre>";
		// {
		// 	"main": "/assets/img/products/4/1.png" , 
		// 	"others": [
		// 		{"url": "/assets/img/products/4/2.png"},
		// 		{"url": "/assets/img/products/4/3.png"},
		// 		{"url": "/assets/img/products/4/4.png"}
		// 	]
		// }
	}

}
