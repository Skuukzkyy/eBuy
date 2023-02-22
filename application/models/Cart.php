<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Model {

    function get_all(){
    }

    function add($form_data){
        $product = $this->product_exist($form_data['product_id']);
        if($product != null){
            $query = "UPDATE cart_products SET quantity = ?, updated_at = ? WHERE user_id = ? AND product_id = ?";
            $values = array($product['quantity'] + $form_data['quantity'], date("Y-m-d H:i:s"), $this->session->userdata('user_id'), $form_data['product_id']);
        }else{
            $query = "INSERT INTO cart_products (user_id, product_id, quantity) VALUES(?,?,?)";
            $values = array($this->session->userdata('user_id'), $form_data['product_id'], $form_data['quantity']);
        }
        $this->db->query($query, $values);
    }

    function count(){
        return $this->db->query("SELECT COUNT(*) as total FROM cart_products WHERE user_id = ?", array($this->session->userdata('user_id')))->row_array();
    }

    function product_exist($product_id){
        $query = "SELECT * FROM cart_products WHERE user_id = ? AND product_id = ?";
        $values = array($this->session->userdata('user_id'), $product_id);
        return $this->db->query($query, $values)->row_array();
    }

    function validate(){
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|greater_than[0]');
        if($this->form_validation->run() === FALSE){
            return validation_errors();
        }else{
            return 'success';
        }
    }

}