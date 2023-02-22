<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href = "https://code.jquery.com/ui/1.10.4/themes/overcast/jquery-ui.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="/assets/css/shopping-cart-style.css"/>
        <link rel="stylesheet" href="/assets/css/header.css"/>
        <script src="/assets/js/cart_page.js"></script>
    </head>
    <body>
        <div class="loader-dialog">
                <img src="/assets/img/ajax-loader.gif"/>
        </div>
        <a href="#">View Order History</a>
        
        <div id="message-dialog">Order success!</div>
        <section id="cart_items_table">

        </section>
        <form>
            <h3>Shipping Information</h3>

            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" />

            <label for="city">City:</label>
            <input type="text" name="city"></textarea>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" />

            <label for="state">State:</label>
            <input type="text" name="state">

            <label for="address1">Address:</label>
            <textarea name="address1"></textarea>

            <label for="zipcode">Zipcode:</label>
            <input type="text" name="zipcode">

            <label for="address">Address 2:</label>
            <textarea name="address2"></textarea>
            <!----------------------------------->
            <h3>Billing Information</h3>

            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" />
            
            <label for="state">State:</label>
            <input type="text" name="state">

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" />

            <label for="zipcode">Zipcode:</label>
            <input type="text" name="zipcode">

            <label for="address1">Address:</label>
            <textarea name="address1"></textarea>

            <label for="card">Card:</label>
            <input type="text" name="card">

            <label for="address">Address 2:</label>
            <textarea name="address2"></textarea>

            <label for="security_code">Card Security Code:</label>
            <input type="text" name="security_code">

            <label for="city">City:</label>
            <input type="text" name="city">

            <label for="expiration">Card Expiration:</label>
            <input type="month" name="expiration">

            <input type="submit" id="pay_button" value="Pay">
        </form>

    </body>
</html>