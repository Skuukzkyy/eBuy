<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model {

    function get_all(){
        $query = "SELECT * FROM product_categories ORDER BY name";
        return $this->db->query($query)->result_array();
    }

    function get_category_with_product(){
        $query = "SELECT product_categories.id, product_categories.name, COUNT(*) as product_count 
                    FROM product_categories
                    INNER JOIN products ON products.category_id = product_categories.id
                    GROUP BY product_categories.id
                ";
        return $this->db->query($query)->result_array();
    }

}