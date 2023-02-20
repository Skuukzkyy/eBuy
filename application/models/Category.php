<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model {

    function get_all(){
        $query = "SELECT * FROM product_categories ORDER BY name";
        return $this->db->query($query)->result_array();
    }

    function get_by_id($category_id){
        return $this->db->query("SELECT * FROM product_categories WHERE id = ?", array($category_id))->row_array();
    }

    function get_category_with_product(){
        $query = "SELECT product_categories.id, product_categories.name, COUNT(*) as product_count 
                    FROM product_categories
                    INNER JOIN products ON products.category_id = product_categories.id
                    GROUP BY product_categories.id
                ";
        return $this->db->query($query)->result_array();
    }

    function update($form_data){
        $query = "UPDATE product_categories SET name = ?, updated_at = NOW() WHERE id = ?";
        $values = array($form_data['category'], $form_data['category_id']);
        $this->db->query($query, $values);
    }

    function create($category_name){
        $query = "INSERT INTO product_categories(name) VALUES(?)";
        $values = array($category_name);
        $this->db->query($query, $values);
        $new_category_id = $this->db->insert_id();
        return $new_category_id;
    }

    // function validate($form_data){
    //     if($form_data['category'] == ''){
    //         return 'Category Name cannot be empty';
    //     }else{
    //         return 'success';
    //     }

    // }

}