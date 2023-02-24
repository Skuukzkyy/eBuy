<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Jerick Arlantico">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href = "https://code.jquery.com/ui/1.10.4/themes/overcast/jquery-ui.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://checkout.stripe.com/checkout.js"></script>
        <link rel="stylesheet" href="/assets/css/shopping-cart-style.css"/>
        <link rel="stylesheet" href="/assets/css/header.css"/>
        <script src="/assets/js/cart_page.js"></script>
    </head>
    <body>
        <div class="loader-dialog">
                <img src="/assets/img/ajax-loader.gif"/>
        </div>

        <div class="error"><?= $this->session->flashdata('error_message') ?></div>
        <div class="success"><?= $this->session->flashdata('success_message') ?></div>
        <a href="/users/history">View Order History</a>
        <section id="cart_items_table">

        </section>
        <form method="POST" action="/users/checkout" id="checkout">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <h3>Shipping Information</h3>

            <label for="first_name">First Name:</label>
            <input type="text" name="shipping_first_name" value="<?= (empty($shipping_address['first_name'])) ? '' : $shipping_address['first_name'] ?>" />

            <label for="last_name">Last Name:</label>
            <input type="text" name="shipping_last_name" value="<?= (empty($shipping_address['last_name'])) ? '' : $shipping_address['last_name'] ?>" />

            <label for="address1">Address:</label>
            <textarea name="shipping_address1"><?= (empty($shipping_address['address'])) ? '' : $shipping_address['address'] ?></textarea>
            
            <label for="address">Address 2:</label>
            <textarea name="shipping_address2"><?= (empty($shipping_address['alternative_address'])) ? '' : $shipping_address['alternative_address'] ?></textarea>

            <label for="city">City:</label>
            <input type="text" name="shipping_city" value="<?= (empty($shipping_address['city'])) ? '' : $shipping_address['city'] ?>"></textarea>

            <label for="state">State:</label>
            <input type="text" name="shipping_state" value="<?= (empty($shipping_address['state'])) ? '' : $shipping_address['state'] ?>">

            <label for="zipcode">Zipcode:</label>
            <input type="text" name="shipping_zipcode" value="<?= (empty($shipping_address['zip_code'])) ? '' : $shipping_address['zip_code'] ?>">

            <!----------------------------------->
            <h3>Billing Information</h3>

            <label for="first_name">First Name:</label>
            <input type="text" name="billing_first_name" value="<?= (empty($billing_address['first_name'])) ? '' : $billing_address['first_name'] ?>" />

            <label for="last_name">Last Name:</label>
            <input type="text" name="billing_last_name" value="<?= (empty($billing_address['last_name'])) ? '' : $billing_address['last_name'] ?>" />

            <label for="address1">Address:</label>
            <textarea name="billing_address1"><?= (empty($billing_address['address'])) ? '' : $billing_address['address'] ?></textarea>
            
            <label for="address">Address 2:</label>
            <textarea name="billing_address2"><?= (empty($billing_address['alternative_address'])) ? '' : $billing_address['alternative_address'] ?></textarea>

            <label for="city">City:</label>
            <input type="text" name="billing_city" value="<?= (empty($billing_address['city'])) ? '' : $billing_address['city'] ?>"></textarea>

            <label for="state">State:</label>
            <input type="text" name="billing_state" value="<?= (empty($billing_address['state'])) ? '' : $billing_address['state'] ?>">

            <label for="zipcode">Zipcode:</label>
            <input type="text" name="billing_zipcode" value="<?= (empty($billing_address['zip_code'])) ? '' : $billing_address['zip_code'] ?>">

            <button id="pay_button">Pay</button>
        </form>

    </body>
</html>