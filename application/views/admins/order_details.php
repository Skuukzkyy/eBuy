<?php
    $status = array(0 => array('status' => 'Cancelled', 'class' => 'fail'), 1 => array('status' => 'Order in progress', 'class' => 'in_progress') , 2 => array('status' => 'Shipped', 'class' => 'success'));
    // gett  address as array object
    $shipping_address = $order_details['shipping_address'];
    $shipping_address = json_decode($shipping_address);
    $shipping_address = $shipping_address->shipping_address;
    $billing_address = $order_details['billing_address'];
    $billing_address = json_decode($billing_address);
    $billing_address = $billing_address->billing_address;
    // gett ordered products address as array object
    $ordered_products = $order_details['ordered_products'];
    $ordered_products = json_decode($ordered_products);
    $ordered_products = $ordered_products->ordered_products;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link rel="stylesheet" href="/assets/css/order-details-style.css"/>
        <link rel="stylesheet" href="/assets/css/header.css"/>
    </head>
    <body>
        <summary>
            <h3>Order ID: <?= $order_details['id'] ?></h3>

            <strong>Customer Shipping Info:</strong>
            <p>Name: <?= $shipping_address->name ?></p>
            <p>Address: <?= $shipping_address->address ?></p>
            <p>City: <?= $shipping_address->city ?></p>
            <p>State: <?= $shipping_address->state ?></p>
            <p>Zip: <?= $shipping_address->zip_code ?></p>

            <strong>Customer Billing Info:</strong>
            <p>Name: <?= $billing_address->name ?></p>
            <p>Address: <?= $billing_address->address ?></p>
            <p>City: <?= $billing_address->city ?></p>
            <p>State: <?= $billing_address->state ?></p>
            <p>Zip: <?= $billing_address->zip_code ?></p>

        </summary>
        <section>
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Item</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
                    </tr>                
                </thead>
                <tbody>
<?php
    foreach($ordered_products as  $product){
?>
                    <tr>
                        <td><?= $product->product_id ?></td>
                        <td class="product_name"><?= $product->product_name ?></td>
                        <td>₱<?= $product->product_price ?></td>
                        <td><?= $product->quantity ?></td>
                        <td>₱<?= $product->total ?></td>
                    </tr>
<?php
    }
?>
                </tbody>
            </table>
            <p class="<?= $status[$order_details['status']]['class'] ?>">Status: <?= $status[$order_details['status']]['status'] ?></p>
            <div>
                <p>Subtotal: ₱<?= $order_details['total_cost'] - $order_details['shipping_fee'] ?></p>
                <p>Shipping: ₱<?= $order_details['shipping_fee'] ?></p>
                <p>Total Price: ₱<?= $order_details['total_cost'] ?></p>
            </div>
        </section>
    </body>
</html>