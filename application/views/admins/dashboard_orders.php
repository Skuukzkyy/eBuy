<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link rel="stylesheet" href="/assets/css/header.css"/>
        <link rel="stylesheet" href="/assets/css/dashboard-orders-style.css"/>
    </head>
    <body>
        <nav>
            <div>
                <img src='./img/magnifying_glass.png' />
                <input type="search" name="search_keyword" placeholder="search">
            </div>
            <select name="status">
                <option selected disabled hidden>Show All</option>
                <option value="order_in_process">Order in process</option>
                <option value="shipped">Shipped</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </nav>
        <table>
            <thead>
                <tr>
                    <td>Order ID</td>
                    <td>Name</td>
                    <td>Date</td>
                    <td>Billing Address</td>
                    <td>Total</td>
                    <td>Status Order</td>
                </tr>                
            </thead>
            <tbody>
                <tr>
                    <td><a href="./order_details.html">101</a></td>
                    <td>Marlon</td>
                    <td>9/12/2020</td>
                    <td>456 Steve Street, Marikina City</td>
                    <td>$10.00</td>
                    <td>
                        <select name="status">
                            <option value="order_in_process">Order in process</option>
                            <option value="shipped">Shipped</option>
                            <option value="cancelled" selected>Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><a href="./order_details.html">100</a></td>
                    <td>Karen</td>
                    <td>8/27/2020</td>
                    <td>123 Commmonwealth, Quezon City</td>
                    <td>$15.00</td>
                    <td>
                        <select name="status">
                            <option value="order_in_process">Order in process</option>
                            <option value="shipped" selected>Shipped</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <footer>
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">&#8594;</a>
        </footer>
    </body>
</html>