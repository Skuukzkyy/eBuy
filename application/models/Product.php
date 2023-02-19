<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model {

    function get_all($order_by){
        return $this->db->query("SELECT * FROM products ORDER BY $order_by DESC")->result_array();
    }

    function get_by_category($search_keyword, $order_by){

        $query = "SELECT * FROM products WHERE name LIKE ?";
        $values = array("%$search_keyword%");
        
        if($this->session->userdata('current_category_id') != null && $this->session->userdata('current_category_id') != '0'){
            $query .= " AND category_id = ?";
            $values[] = $this->session->userdata('current_category_id');
        }

        $query .= " ORDER BY $order_by DESC";
        // $query = "SELECT * FROM products WHERE category_id = ? AND name LIKE ? ORDER BY $order_by DESC"; 
        return $this->db->query($query, $values)->result_array();
    }

}