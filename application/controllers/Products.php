<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Product');
		$this->load->model('Category');
	}

	public function index(){
		$data['categories'] = $this->Category->get_all();

		$this->load->view('/partials/header');
		$this->load->view('/products/products_page', $data);
	}

	public function load_products(){
		// $this->output->enable_profiler(TRUE);
		$order_by = $this->input->post('sorted_by', TRUE);
		$category_id = $this->input->post('category_id', TRUE);
		$search_keyword = $this->input->post('search_keyword', TRUE);
		// var_dump($search_keyword); die();
		if($category_id != null){
			$this->session->set_userdata('current_category_id', $category_id);
		}
		$data['products'] = $this->Product->get_by_category($search_keyword, $order_by);

		$this->load->view('/partials/products', $data);
	}

    public function show($product_id){
		$this->load->view('/partials/header');
        $this->load->view('/products/item_page.php');
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
		$values = array(1, 'White Tshirt', 'Kulay Puti', 80, 500, json_encode($images));
		$this->db->query($query, $values);

		$product = $this->db->query("SELECT * FROM products where id = 5")->row_array();
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
