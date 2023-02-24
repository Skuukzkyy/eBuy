<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link href = "https://code.jquery.com/ui/1.10.4/themes/overcast/jquery-ui.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>    
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>    
        <link rel="stylesheet" href="/assets/css/edit-profile-style.css"/>
        <link rel="stylesheet" href="/assets/css/header.css"/>
        <script src="/assets/js/edit_profile.js"></script>
    </head>
    <body>
        <div class="error"><?= $this->session->flashdata('error_message') ?></div>
        <div class="success"><?= $this->session->flashdata('success_message') ?></div>

        <fieldset>            
            <legend>Edit Password</legend>
            <form method="POST" action="/users/update_password">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <label for="old_password">Old Password:</label>
                <input type="password" name="old_password" />
    
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" />
    
                <label for="confirm_new_password">Confirm New Password:</label>
                <input type="password" name="confirm_new_password" />

                <input type="submit" message="Password successfully updated!" value="Save">
            </form>
        </fieldset>

        <fieldset>
            <legend>Edit Default Shipping</legend>
            <form method="POST" action="/users/update_shipping" id="default_shipping">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" value="<?= (empty($shipping_address['first_name'])) ? '' : $shipping_address['first_name'] ?>" />

                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" value="<?= (empty($shipping_address['last_name'])) ? '' : $shipping_address['last_name'] ?>" />

                <label for="address1">Address:</label>
                <textarea name="address1"><?= (empty($shipping_address['address'])) ? '' : $shipping_address['address'] ?></textarea>
                
                <label for="address">Address 2:</label>
                <textarea name="address2"><?= (empty($shipping_address['alternative_address'])) ? '' : $shipping_address['alternative_address'] ?></textarea>

                <label for="city">City:</label>
                <input type="text" name="city" value="<?= (empty($shipping_address['city'])) ? '' : $shipping_address['city'] ?>"></textarea>

                <label for="state">State:</label>
                <input type="text" name="state" value="<?= (empty($shipping_address['state'])) ? '' : $shipping_address['state'] ?>">

                <label for="zipcode">Zipcode:</label>
                <input type="text" name="zipcode" value="<?= (empty($shipping_address['zip_code'])) ? '' : $shipping_address['zip_code'] ?>">

                <input type="submit" message="Shipping information successfully updated!" value="Save">
            </form>
            <a href="#" id="same_as_billing">Same as billing</a>
        </fieldset>
        <fieldset>
            <legend>Edit Default Billing</legend>
            <form method="POST" action="/users/update_billing" id="default_billing">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" value="<?= (empty($billing_address['first_name'])) ? '' : $billing_address['first_name'] ?>" />

                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" value="<?= (empty($billing_address['last_name'])) ? '' : $billing_address['last_name'] ?>" />

                <label for="address1">Address:</label>
                <textarea name="address1"><?= (empty($billing_address['address'])) ? '' : $billing_address['address'] ?></textarea>
                
                <label for="address">Address 2:</label>
                <textarea name="address2"><?= (empty($billing_address['alternative_address'])) ? '' : $billing_address['alternative_address'] ?></textarea>

                <label for="city">City:</label>
                <input type="text" name="city" value="<?= (empty($billing_address['city'])) ? '' : $billing_address['city'] ?>"></textarea>

                <label for="state">State:</label>
                <input type="text" name="state" value="<?= (empty($billing_address['state'])) ? '' : $billing_address['state'] ?>">

                <label for="zipcode">Zipcode:</label>
                <input type="text" name="zipcode" value="<?= (empty($billing_address['zip_code'])) ? '' : $billing_address['zip_code'] ?>">

                <input type="submit" message="Billing information successfully updated!" value="Save">
            </form>
                <a href="#" id="same_as_shipping">Same as Shipping</a>
        </fieldset>

    </body>
</html>