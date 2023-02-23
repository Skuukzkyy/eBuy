<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link rel="stylesheet" href="/assets/css/header.css"/>
        <link rel="stylesheet" href="/assets/css/dashboard-orders-style.css"/>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="/assets/js/admins/dashboard_orders.js"></script>
    </head>
    <body>
        <nav>
            <div>
                <img src='/assets/img/magnifying_glass.png' />
                <input type="search" name="search_keyword" id="search_keyword" placeholder="search">
                <input type="hidden" name="page_number" id="page_number" value="1">
            </div>
            <select id="filter" name="filter">
                <option value="*" selected>Show All</option>
                <option value="1">Order in process</option>
                <option value="2">Shipped</option>
                <option value="0">Cancelled</option>
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

            </tbody>
        </table>
        <footer>
        </footer>
    </body>
</html>