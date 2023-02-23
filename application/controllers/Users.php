<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('User');
		$this->load->model('Cart');
		$this->load->model('Order');
		$this->load->model('Product');
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
		$result = $this->User->validate();
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
		$data['shipping_address'] = $this->User->get_shipping($this->session->userdata('user_id'));
		$data['billing_address'] = $this->User->get_billing($this->session->userdata('user_id'));
		$this->load->view('/partials/header', $data);
		$this->load->view('/users/edit_profile', $data);
	}

	public function update_password(){
		$form_data = $this->input->post(NULL, TRUE);
		var_dump($form_data);
		$result = $this->User->validate_update_password();
		if($result == 'success'){
			$result = $this->User->update_password($form_data, $this->session->userdata('user_id'));
			if(($result) == 'success'){
				$this->session->set_flashdata('success_message', 'Password has been updated.');
				redirect('/users/profile');
			}
		}
		$this->session->set_flashdata('error_message', $result);
		redirect('/users/profile');
	}

	public function update_shipping(){
		$form_data = $this->input->post(NULL, TRUE);
		var_dump($form_data);
		$result = $this->User->validate_shipping_billing();
		if($result == 'success'){
			$this->User->update_shipping($form_data, $this->session->userdata('user_id'));
			$this->session->set_flashdata('success_message', 'Default Shipping has been updated.');
		}else{
			$this->session->set_flashdata('error_message', $result);
		}
		redirect('/users/profile');
	}

	public function update_billing(){
		$form_data = $this->input->post(NULL, TRUE);
		var_dump($form_data);
		$result = $this->User->validate_shipping_billing();
		if($result == 'success'){
			$this->User->update_billing($form_data, $this->session->userdata('user_id'));
			$this->session->set_flashdata('success_message', 'Default Billing has been updated.');
		}else{
			$this->session->set_flashdata('error_message', $result);
		}
		redirect('/users/profile');
	}
	
    public function carts(){
		if($this->session->userdata('user_id') == null){
			redirect('/');
		}
		$data['cart_count']  = $this->Cart->count();
		$data['shipping_address'] = $this->User->get_shipping($this->session->userdata('user_id'));
		$data['billing_address'] = $this->User->get_billing($this->session->userdata('user_id'));
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

	public function checkout(){
		$form_data = $this->input->post(NULL, TRUE);
		$validate = $this->Order->validate();
		if($validate != 'success'){
			$this->session->set_flashdata('error_message', $validate);
			echo 'fail';
			return FALSE;
		}
		$user_id = $this->session->userdata('user_id');
		// var_dump($this->input->post(NULL, TRUE));

		$this->Order->validate();
		$cart_items = $this->Cart->get_all($user_id);
		if($cart_items == null){
			$this->session->set_flashdata('error_message', 'There is no product in the cart');
			echo 'fail';
			return FALSE;
		}
		$sub_total = 0;
		$products_list = array();
		foreach($cart_items as $cart_item){
			$products_list[] = $cart_item['product_name']. ' (' .$cart_item['quantity']. ')';
			$sub_total += $cart_item['product_price'] * $cart_item['quantity'];
			$ordered_products['ordered_products'][] = array(
				"product_id" => $cart_item['product_id'],
				"product_name" => $cart_item['product_name'],
				"product_price" => $cart_item['product_price'],
				"quantity" => $cart_item['quantity'],
				"total" => $cart_item['product_price'] * $cart_item['quantity']
			);
		}
		$json_ordered_prodducts = json_encode($ordered_products);
		$shipping_address['shipping_address'] = array(
			"name" => $form_data['shipping_first_name']. ' ' .$form_data['shipping_last_name'],
			"address" => $form_data['shipping_address1'],
			"alternative_address" => $form_data['shipping_address2'],
			"city" => $form_data['shipping_city'],
			"state" => $form_data['shipping_state'],
			"zip_code" => $form_data['shipping_zipcode']
		);

		$billing_address['billing_address'] = array(
			"name" => $form_data['billing_first_name']. ' ' .$form_data['billing_last_name'],
			"address" => $form_data['billing_address1'],
			"alternative_address" => $form_data['billing_address2'],
			"city" => $form_data['billing_city'],
			"state" => $form_data['billing_state'],
			"zip_code" => $form_data['billing_zipcode']
		);
		
		$json_shipping_address = json_encode($shipping_address);
		$json_billing_address = json_encode($billing_address);
		foreach($cart_items as $cart_item){
			$this->Product->add_sold_items($cart_item);
		}
		$this->session->set_flashdata('success_message', 'Ordered Successfully.');
		$this->Order->new($user_id, $json_ordered_prodducts, $json_shipping_address, $json_billing_address, $sub_total);
		$this->Cart->delete_all($user_id);
		$this->send_email($products_list, $sub_total);
		echo 'success';
		// if res == success then stripe;
	}

	public function history(){
		$user_id = $this->session->userdata('user_id');
		$data['cart_count']  = $this->Cart->count();
		$data['user_orders'] = $this->Order->get_by_user_id($user_id);
		$this->load->view('/partials/header', $data);
        $this->load->view('/users/order_history.php', $data);
	}

	public function update_header(){
		$data['cart_count']  = $this->Cart->count();
		$this->load->view('/partials/header', $data);
	}

	public function send_email($products_list, $sub_total){
		$products_string = '';
		foreach($products_list as $product){
			$products_string .= $product. '<br>';
		}
		$this->load->library('phpmailer_lib');
		// PHPMailer object
		$mail = $this->phpmailer_lib->load();
		try {
			//Server settings
			$mail->SMTPDebug = 0;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'movie.tastic69@gmail.com';                     //SMTP username
			$mail->Password   = 'mvtuhmbdywpiivjt';                               //SMTP password
			$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
			$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//sender
			$mail->setFrom('movie.tastic69@gmail.com', 'eBuy eCommerce');
			// recepient
			$mail->addAddress('arlanticojerick09@gmail.com');               
			$mail->addReplyTo('movie.tastic69@gmail.com');

			//Attachments
			// $mail->AddEmbeddedImage('img/'.$banner1.'', 'movie_banner');
			// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'Order Receipt';
			$mail->Body    = '
				THANK YOU FOR BUYING ON <strong>eBuy</strong>!<br>
				Here are the items you bought:<br>
				'.$products_string.'<br>
				<strong>Shipping Fee: 50</strong><br>
				<strong>Sub Total: ' .$sub_total. '</strong><br>
				<strong>Total Cost: ' .($sub_total + 50). '</strong>';

			$mail->send();
			// header("Location: index.php");
		} catch (Exception $e){
		}
	}

}
