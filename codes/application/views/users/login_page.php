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

        <form action="/users/login_process" method="POST">  
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />  
            <h1>Login</h1>

            <label for="email">Email address:</label>
            <input type="text" name="email" id="email" value="<?= $this->session->flashdata('email') ?>">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?= $this->session->flashdata('password') ?>">
        
            <input type="submit" value="Signin">
            <a href="/users/register">Don't have an account? Register</a>
        </form>
    </body>
</html>

