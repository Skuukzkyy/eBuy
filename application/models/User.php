<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    function get_by_email($email){
        return $this->db->query("SELECT * FROM users WHERE email_address = ?", array($email))->row_array();
    }

    function create($form_data){
        $salt = bin2hex(openssl_random_pseudo_bytes(10));
        $encrypted_password = md5($form_data['password'] . $salt);
        $query = "INSERT INTO users(first_name, last_name, email_address, password, salt) VALUES(?,?,?,?,?)";
        $values = array($form_data['first_name'], $form_data['last_name'], $form_data['email'], $encrypted_password, $salt);
        $this->db->query($query, $values);
    }

    function verify($form_data){
        $user = $this->get_by_email($form_data['email']);
        //email has match
        if($user != NULL){
            $user_salt = $user['salt'];
            $password_given = md5($form_data['password'] . $user_salt); 

            if($password_given == $user['password']){ 
                $this->session->set_userdata('user_id', $user['id']);
                return 'success';
            }
        }
        // wrong login crededntials
        $this->session->set_flashdata($form_data);
        return "Incorrect email or password";
    }

    function validate($form_data){
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
            $this->session->set_flashdata($form_data);
            return validation_errors();
        }else{
            return 'success';
        }
    }

}