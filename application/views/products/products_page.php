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
        <form action="./search-keyword.html" method="POST">
            <div>
                <img src='./img/magnifying_glass.png' />
                <input type="search" name="search_keyword" placeholder="search">
            </div>
            <ul>
                <strong>Categories</strong>
<?php
    foreach($categories as $category){
?>
                <li><a href="/products/category/<?= $category['id'] ?>/1"><?= $category['name'] ?> (<?= $category['product_count'] ?>)</a></li>
<?php
    }
?>
                <li><a href="/products/category/0/1">Show All</a></li>
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
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" name="current_category" value="<?= $current_category ?>">
                <label for="sorted_by">Sorted by</label>
                <select name="sorted_by" id="sorted_by">
                    <option value="price" selected>Price</option>
                    <option value="quantity_sold">Most Popular</option>
                </select>
            </form>
            <!-- Display Products -->
            <section id="products"></section>
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">&#8594;</a>
            </footer>
        </main>
    </body>
</html>