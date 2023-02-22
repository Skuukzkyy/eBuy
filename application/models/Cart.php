<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Model {

    function get_all($user_id){
        $query = "SELECT cart_products.*, products.name AS product_name, products.price AS product_price
                FROM cart_products 
                INNER JOIN products ON products.id = cart_products.product_id 
                WHERE user_id = ?;";
        return $this->db->query($query, array($user_id))->result_array();
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

    function update_quantity($user_id, $form_data){
        $query = "UPDATE cart_products SET quantity = ?, updated_at = ? WHERE user_id = ? AND product_id = ?";
        $values = array($form_data['quantity'], date("Y-m-d H:i:s"), $user_id, $form_data['product_id']);
        $this->db->query($query, $values);
    }

    function delete_item($product_id, $user_id){
        $this->db->query("DELETE FROM cart_products WHERE product_id = ? AND user_id = ?", array($product_id, $user_id));
    }

    function delete_all($user_id){
        $this->db->query("DELETE FROM cart_products WHERE user_id = ?", array($user_id));
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