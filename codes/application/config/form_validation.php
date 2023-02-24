<?php

$config = array(
    'login' => array(
        array(
                'field' => 'username',
                'label' => 'User Name',
                'rules' => array('required', 'min_length[5]'),
                'errors' => array('min_length' => 'ikli par')
        ),
        array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
        ),
        array(
                'field' => 'passconf',
                'label' => 'Verify Password',
                'rules' => 'matches[password]'
        ),
        array(
                'field' => 'email',
                'label' => 'Email Address',
                'rules' => 'required|valid_email'
        ),
        // array(
        //     'field' => 'phone',
        //     'label' => 'Phone number',
        //     'rules' => 'required'
        // )
    )
);