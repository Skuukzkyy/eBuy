<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model {

    function get_all(){
        return $this->db->query("SELECT * FROM products")->result_array();
    }

    function get_by_name_or_id($search_keyword){
        $query = "SELECT * FROM products WHERE id = ? OR name LIKE ?";
        $values = array($search_keyword, "%$search_keyword%");
        return $this->db->query($query, $values)->result_array();
    }

    function get_by_id($product_id){
        $query = "SELECT products.*, product_categories.name AS category  FROM products 
                INNER JOIN product_categories
                ON product_categories.id = products.category_id
                WHERE products.id = ?
        ";
        $values = array($product_id);
        return $this->db->query($query, $values)->row_array();
    }

    function get_similar_product($category_id, $product_id){
        $query ="SELECT * FROM products WHERE category_id = ? AND id != ?";
        $values = array($category_id, $product_id);
        return $this->db->query($query, $values)->result_array();
    }

    function get_max_id(){
        return $this->db->query("SELECT MAX(id) as max_id FROM products")->row_array();
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

    function create($form_data){
        $query = "INSERT INTO products(category_id, name, description, price, inventory_count, images)
                VALUES(?,?,?,?,?,?)
        ";
        $values = array($form_data['category'], $form_data['name'], $form_data['description'], $form_data['price'], $form_data['stock'], $form_data['images']);
        $this->db->query($query, $values);
    }

    function update($form_data){
        $query = "UPDATE products
                SET category_id = ?, name = ?, description  = ?, price =  ?, inventory_count = ?, images = ?, updated_at = ?
                WHERE  id = ?
        ";
        $values = array(
            $form_data['category'],
            $form_data['name'],
            $form_data['description'],
            $form_data['price'],
            $form_data['stock'],
            $form_data['images'],
            date("Y-m-d H:i:s"),
            $form_data['product_id']
        );

        $this->db->query($query, $values);
    }

    function delete($product_id){
        $this->db->query("DELETE FROM products WHERE id = ?", $product_id);
    }

    function validate(){
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Product Name',
                'rules' => 'required',
            ),
            array(
                'field' => 'description',
                'label' => 'Product Description',
                'rules' => 'required',
            ),
            array(
                'field' => 'category',
                'label' => 'Product Category',
                'rules' => 'required',
            ),
            array(
                'field' => 'price',
                'label' => 'Product Price',
                'rules' => 'required',
            ),
            array(
                'field' => 'stock',
                'label' => 'Product Stock',
                'rules' => 'required',
            )
        );

        $this->form_validation->set_rules($config);
        if($this->form_validation->run() === FALSE){
            return validation_errors();
        }else{
            return 'success';
        }
    }

}