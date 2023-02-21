<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link rel="stylesheet" href="/assets/css/products_page.css"/>
        <link rel="stylesheet" href="/assets/css/header.css"/>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="/assets/js/products_page.js"></script>
    </head>
    <body>
        <form action="/products/load_products" method="POST" id="search">
            <div>
                <img src='/assets/img/magnifying_glass.png' />
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" name="page_number" value="1">
                <input type="search" name="search_keyword" id="search_keyword" placeholder="search">
            </div>
            <ul>
                <strong>Categories</strong>
<?php
    foreach($categories as $category){
?>
                <li><a href="<?= $category['id'] ?>" class="category"><?= $category['name'] ?> (<?= $category['product_count'] ?>)</a></li>
<?php
    }
?>
                <li><a href="0" class="category">Show All</a></li>
            </ul>
        </form>
        <main>
            <h2>All Products (page 2)</h2>
            <nav>
                <a href="#">first</a>
                <a href="#">prev</a>
                <span>2</span>
                <a href="#">next</a>
            </nav>
            <form action="/products/load_products" method="POST" id="sort">
                <label for="sorted_by">Sorted by</label>
                <select name="sorted_by" id="sorted_by">
                    <option value="price" selected>Price</option>
                    <option value="quantity_sold">Most Popular</option>
                </select>
            </form>
            <!-- Display Products -->
            <section id="products">
            </section>
        </main>
    </body>
</html>