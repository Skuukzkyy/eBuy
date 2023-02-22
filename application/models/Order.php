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

}