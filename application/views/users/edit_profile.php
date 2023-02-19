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
        <link rel="stylesheet" href="/assets/css/edit-profile-style.css"/>
        <link rel="stylesheet" href="/assets/css/header.css"/>
        <script>
            $(document).ready(function() {
                $("#message-dialog").dialog({
                    autoOpen: false
                });
                $(document).on('click', 'input[type="submit"]', function() {
                    $('#message-dialog').html($(this).attr('message'));
                    $("#message-dialog").dialog("open");
                    return false;
                });
            });
        </script>
    </head>
    <body>
        <div id="message-dialog"></div>
        <fieldset>            
            <legend>Edit Password</legend>
            <form>
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
            <form>
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" />

                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" />

                <label for="address1">Address:</label>
                <textarea name="address1"></textarea>
                
                <label for="address">Address 2:</label>
                <textarea name="address2"></textarea>

                <label for="city">City:</label>
                <input type="text" name="city"></textarea>

                <label for="state">State:</label>
                <input type="text" name="state">

                <label for="zipcode">Zipcode:</label>
                <input type="text" name="zipcode">

                <input type="submit" message="Shipping information successfully updated!" value="Save">
            </form>
        </fieldset>

        <fieldset>
            <legend>Edit Default Billing</legend>
            <form>
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" />
                
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" />

                <label for="address1">Address:</label>
                <textarea name="address1"></textarea>
                
                <label for="address">Address 2:</label>
                <textarea name="address2"></textarea>

                <label for="city">City:</label>
                <input type="text" name="city">

                <label for="state">State:</label>
                <input type="text" name="state">
    
                <label for="zipcode">Zipcode:</label>
                <input type="text" name="zipcode">
    
                <label for="card">Card:</label>
                <input type="text" name="card">
    
                <label for="security_code">Card Security Code:</label>
                <input type="text" name="security_code">
    
                <label for="expiration">Card Expiration:</label>
                <input type="month" name="expiration">
    
                <input type="submit" message="Billing information successfully updated!" value="Save">
            </form>
        </fieldset>

    </body>
</html>