<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link rel="stylesheet" href="/assets/css/login-register-style.css"/>
        <link rel="stylesheet" href="/assets/css/header.css"/>
    </head>
    <body>

        <div class="error"><?= $this->session->flashdata('error_message') ?></div>

        <form action="/users/registration_process" method="POST">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <h1>Register</h1>
            
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="<?= $this->session->flashdata('first_name') ?>" />

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name"  id="last_name" value="<?= $this->session->flashdata('last_name') ?>" />

            <label for="email">Email address:</label>
            <input type="text" name="email" id="email" value="<?= $this->session->flashdata('email') ?>" >

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?= $this->session->flashdata('password') ?>" >

            <label for="confirm_password">Repeat Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" value="<?= $this->session->flashdata('confirm_password') ?>" ><br>
                        
            <input type="submit" value="Register">
            <a href="/users/login">Already have an account? Log in</a>
        </form>

        
    </body>
</html>