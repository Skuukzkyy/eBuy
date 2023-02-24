<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    function get_by_email($email){
        return $this->db->query("SELECT * FROM users WHERE email_address = ?", array($email))->row_array();
    }

    function get_by_id($user_id){
        return $this->db->query("SELECT * FROM users WHERE id = ?", array($user_id))->row_array();
    }

    function get_shipping($user_id){
        return $this->db->query("SELECT * FROM addresses WHERE user_id = ? AND type = 1", array($user_id))->row_array();
    }

    function get_billing($user_id){
        return $this->db->query("SELECT * FROM addresses WHERE user_id = ? AND type = 2", array($user_id))->row_array();
    }

    function create($form_data){
        $salt = bin2hex(openssl_random_pseudo_bytes(10));
        $encrypted_password = md5($form_data['password'] . $salt);
        $query = "INSERT INTO users(first_name, last_name, email_address, password, salt) VALUES(?,?,?,?,?)";
        $values = array($form_data['first_name'], $form_data['last_name'], $form_data['email'], $encrypted_password, $salt);
        $this->db->query($query, $values);
    }

    function update_password($form_data, $user_id){
        $user = $this->get_by_id($user_id);
        $encrypted_password = md5($form_data['old_password'] . $user['salt']);
        if($encrypted_password == $user['password']){
            $new_encrypted_password = md5($form_data['new_password'] . $user['salt']);
            $this->db->query("UPDATE users SET password = ?, updated_at = ? WHERE id = ?", array($new_encrypted_password, date("Y-m-d H:i:s"), $user_id));
            return 'success';
        }else{
            return "Incorrect old password";
        }
    }

    function update_shipping($form_data, $user_id){
        $user_has_shipping = $this->get_shipping($user_id);
        if($user_has_shipping){
            $query = "UPDATE addresses SET 
                    first_name = ?, last_name = ?, address = ?, alternative_address = ?, city = ?, state = ?, zip_code = ?, updated_at = ?
                    WHERE user_id = ? AND type = 1
            ";
            $values = array($form_data['first_name'], $form_data['last_name'], $form_data['address1'], $form_data['address2'], $form_data['city'], $form_data['state'], $form_data['zipcode'], date("Y-m-d H:i:s"), $user_id);
        }else{
            $query = "INSERT INTO addresses
                    (user_id, type, first_name, last_name, address, alternative_address, city, state, zip_code)
                    VALUES(?,?,?,?,?,?,?,?,?)
            ";
            $values = array($user_id, 1, $form_data['first_name'], $form_data['last_name'], $form_data['address1'], $form_data['address2'], $form_data['city'], $form_data['state'], $form_data['zipcode']);
        }
        $this->db->query($query, $values);
    }

    function update_billing($form_data, $user_id){
        $user_has_billing = $this->get_billing($user_id);
        if($user_has_billing){
            $query = "UPDATE addresses SET 
                    first_name = ?, last_name = ?, address = ?, alternative_address = ?, city = ?, state = ?, zip_code = ?, updated_at = ?
                    WHERE user_id = ? AND type = 2
            ";
            $values = array($form_data['first_name'], $form_data['last_name'], $form_data['address1'], $form_data['address2'], $form_data['city'], $form_data['state'], $form_data['zipcode'], date("Y-m-d H:i:s"), $user_id);
        }else{
            $query = "INSERT INTO addresses
                    (user_id, type, first_name, last_name, address, alternative_address, city, state, zip_code)
                    VALUES(?,?,?,?,?,?,?,?,?)
            ";
            $values = array($user_id, 2, $form_data['first_name'], $form_data['last_name'], $form_data['address1'], $form_data['address2'], $form_data['city'], $form_data['state'], $form_data['zipcode']);
        }
        $this->db->query($query, $values);
    }

    function verify($form_data){
        $user = $this->get_by_email($form_data['email']);
        //email has match
        if($user != NULL){
            $user_salt = $user['salt'];
            $password_given = md5($form_data['password'] . $user_salt); 

            if($password_given == $user['password']){ 
                if($user['is_admin']){
                    $this->session->set_userdata('is_admin', TRUE);
                }
                $this->session->set_userdata('user_id', $user['id']);
                return 'success';
            }
        }
        // wrong login crededntials
        $this->session->set_flashdata($form_data);
        return "Incorrect email or password";
    }

    function validate_shipping_billing(){
        $config = array(
            array(
                'field' => 'zipcode',
                'label' => 'Zip Code',
                'rules' => array('numeric')
            ),
        );

        $this->form_validation->set_rules($config);
        if($this->form_validation->run() === FALSE){
            return validation_errors();
        }else{
            return 'success';
        }
    }

    function validate_update_password(){
        $config = array(
            array(
                'field' => 'new_password',
                'label' => 'Password',
                'rules' => array('required', 'min_length[8]')
            ),
            array(
                'field' => 'confirm_new_password',
                'label' => 'Confirm Password',
                'rules' => 'matches[new_password]'
            ),
        );

        $this->form_validation->set_rules($config);
        if($this->form_validation->run() === FALSE){
            return validation_errors();
        }else{
            return 'success';
        }
    }

    function validate(){
        $config = array(
            array(
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'last_name',
                'label' => 'Last Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'email',
                'label' => 'Email Address',
                'rules' => array('required', 'valid_email')
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => array('required', 'min_length[8]')
            ),
            array(
                'field' => 'confirm_password',
                'label' => 'Repeat Password',
                'rules' => 'matches[password]'
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