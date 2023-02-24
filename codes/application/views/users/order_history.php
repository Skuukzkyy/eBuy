<?php
    $status = array(0 => 'Cancelled', 1 => 'Order In Progress', 2 => 'Success');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link rel="stylesheet" href="/assets/css/order-history-style.css"/>
        <link rel="stylesheet" href="/assets/css/header.css"/>
    </head>
    <body>
        <h1>ORDER HISTORY</h1>  
        <table>
            <thead>
                <tr>
                    <td>Order ID</td>
                    <td>Shipped to</td>
                    <td>Date</td>
                    <td>Billing Address</td>
                    <td>Total</td>
                    <td>Status Order</td>
                </tr>                
            </thead>
            <tbody>
<?php
    foreach($user_orders as $user_order){
        $billing_address = json_decode($user_order['billing_address']);
        $billing_address = $billing_address->billing_address;
        $shipping_address = json_decode($user_order['shipping_address']);
        $shipping_address = $shipping_address->shipping_address;
?>
                <tr>
                    <td><a href="/orders/show/<?= $user_order['id'] ?>"><?= $user_order['id'] ?></a></td>
                    <td><?= $shipping_address->name ?></td>
                    <td><?= date('m/d/Y', strtotime($user_order['created_at'])) ?></td>

                    <td><?= $billing_address->address. ' ' .$billing_address->city?></td>
                    <td>₱<?= $user_order['total_cost'] ?></td>
                    <td><?= $status[$user_order['status']] ?></td>
                </tr>
<?php
    }
?>
            </tbody>
        </table>
    </body>
</html>