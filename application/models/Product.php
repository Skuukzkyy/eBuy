<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model {

    function get_all($order_by){
        return $this->db->query("SELECT * FROM products ORDER BY $order_by DESC")->result_array();
    }

    function get_by_category($category_id, $order_by){
        if($category_id == 0){
            return $this->get_all($order_by);
        }
        return $this->db->query("SELECT * FROM products WHERE category_id = ? ORDER BY $order_by DESC", array($category_id))->result_array();
    }

}