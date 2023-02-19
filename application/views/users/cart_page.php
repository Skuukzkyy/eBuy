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
    </head>
    <script>
        $(document).ready(function() {
            $("#message-dialog").dialog({
                autoOpen: false
            });
            $('#message-dialog').on('dialogclose', function(event) {
                location.href="order_history.html";
            });
            function toggleQtyField(qtyField) {
                if($(qtyField).hasClass("non-editable-qty")) {
                    $(qtyField).attr("class","editable-qty");
                } else {
                    $(qtyField).attr("class","non-editable-qty");
                }
            }
            $(document).on('click', "img", function() {
                if (confirm($(this).attr('product-name') + " will be deleted. Click to confirm.")) {
                    alert($(this).attr('product-name')+" is now deleted.");
                }
            });
            //submit the form for twice button click
            $(document).on('click', "button#update", function() {
                toggleQtyField($(this).siblings('input'));
                if($(this).attr('clicks') == '0') {
                    return false;
                }
                $(this).attr('clicks', $(this).attr('clicks')%2);
            });
            $(document).on('click', "#pay_button", function() {
                $("#message-dialog").dialog("open");
                return false;
            });
        });
    </script>
    <body>
        <a href="./order_history.html">View Order History</a>
        
        <div id="message-dialog">Order success!</div>
        <section>
            <table>
                <thead>
                    <tr>
                        <td>Item</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
                    </tr>                
                </thead>
                <tbody>
                    <tr>
                        <td>Black Belt for Staff</td>
                        <td>$19.99</td>
                        <td><form><input type="number" min="1" class="non-editable-qty" value="1"/> <button clicks="0" type="button" id="update">update</button> <img product-name="Black Belt for Staff" src="./img/trash-can.png"/></form></td>
                        <td>$19.99</td>
                    </tr>
                    <tr>
                        <td>Coding Dojo Cups</td>
                        <td>$9.99</td>
                        <td><form><input type="number" min="1" class="non-editable-qty" value="2"/> <button clicks="0" type="button" id="update">update</button> <img product-name="Coding Dojo Cups" src="./img/trash-can.png"/></form></td>
                        <td>$29.97</td>
                    </tr>
                </tbody>
            </table>
            <p>Total: $49.96</p>
            <button type="button" onclick="location.href='./catalog.html';">Continue Shopping</button>
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