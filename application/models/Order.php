<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Model {

    function get_all(){
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