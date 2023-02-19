<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model {

    function get_all(){
        $query = "SELECT categories.id, categories.name, COUNT(*) as product_count 
                    FROM v88_ebuy.categories
                    INNER JOIN products ON products.category_id = categories.id
                    GROUP BY categories.id
                ";
        return $this->db->query($query)->result_array();
    }

}