<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Model {

    function get_all(){
        return $this->db->query("SELECT orders.*, users.first_name, users.last_name FROM orders INNER JOIN users ON users.id = orders.user_id")->result_array();
    }

    function update_order_status($order_id, $status){
        $this->db->query("UPDATE orders SET status = ? WHERE id =?", array($status, $order_id));
    }

    function search($search_keyword, $status){
        $query = "SELECT orders.*, users.first_name, users.last_name FROM orders 
            INNER JOIN users ON users.id = orders.user_id
            WHERE (orders.id = ? OR user_id = ? OR users.first_name LIKE ? OR users.last_name LIKE ? OR total_cost LIKE ?)
        ";
        $values = array($search_keyword, $search_keyword, "%$search_keyword%", "%$search_keyword%", "$search_keyword%");

        if($status != '*'){
            $query .= " AND status = ?";
            $values[] = $status;
        }
        // $values[] = $query;
        // return $values;
        return $this->db->query($query, $values)->result_array();
    }

    function new($user_id, $json_ordered_prodducts, $json_shipping_address, $json_billing_address, $sub_total){
        $shipping_fee = 50;
        $query = "INSERT INTO orders(user_id, ordered_products, shipping_address, billing_address, shipping_fee, total_cost)
                VALUES(?,?,?,?,?,?)
        ";
        $values = array($user_id, $json_ordered_prodducts, $json_shipping_address, $json_billing_address, $shipping_fee, $sub_total + $shipping_fee);
        $this->db->query($query, $values);
    }

    function validate(){
        // VALIDATION DIN SA CARD 
        $config = array(
            array(
                'field' => 'shipping_first_name',
                'label' => 'Shipping First Name',
                'rules' => 'required',
            ),
            array(
                'field' => 'shipping_last_name',
                'label' => 'Shipping Last Name',
                'rules' => 'required',
            ),
            array(
                'field' => 'shipping_address1',
                'label' => 'Shipping Address',
                'rules' => 'required',
            ),
            array(
                'field' => 'shipping_city',
                'label' => 'Shipping City',
                'rules' => 'required',
            ),
            array(
                'field' => 'shipping_state',
                'label' => 'Shipping State',
                'rules' => 'required',
            ),
            array(
                'field' => 'shipping_zipcode',
                'label' => 'Shipping Zip Code',
                'rules' => 'required|numeric',
            ),
            array(
                'field' => 'billing_first_name',
                'label' => 'Billing First Name',
                'rules' => 'required',
            ),
            array(
                'field' => 'billing_last_name',
                'label' => 'Billing Last Name',
                'rules' => 'required',
            ),
            array(
                'field' => 'billing_address1',
                'label' => 'Billing Address',
                'rules' => 'required',
            ),
            array(
                'field' => 'billing_city',
                'label' => 'Billing City',
                'rules' => 'required',
            ),
            array(
                'field' => 'billing_state',
                'label' => 'Billing State',
                'rules' => 'required',
            ),
            array(
                'field' => 'billing_zipcode',
                'label' => 'Billing Zip Code',
                'rules' => 'required|numeric',
            ),
        );

        $this->form_validation->set_rules($config);
        if($this->form_validation->run() === FALSE){
            return validation_errors();
        }else{
            return 'success';
        }
    }

}