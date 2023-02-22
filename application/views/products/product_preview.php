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
        <link rel="stylesheet" href="/assets/css/product-details-style.css"/>
        <link rel="stylesheet" href="/assets/css/header.css"/>
        <script src="/assets/js/product_preview.js"></script>
    </head>
    <body>
        <div id="image-preview-dialog">
            <img src="">
        </div> 
        <main>
            <a href="/">Go Back</a>
            <h1><?= $product_details['name'] ?></h1>
            <figure>
<?php
    $images = json_decode($product_details['images']);
?>
                <img class="mini-image" src="/assets/img/products/<?= $product_details['id'] ?>/<?= $images->main ?>">
                <img class="mini-image" src="/assets/img/products/<?= $product_details['id'] ?>/<?= $images->main ?>">
<?php
    foreach($images->others as $sub_image){
?>
            <img class="mini-image" src="/assets/img/products/<?= $product_details['id'] ?>/<?= $sub_image ?>">
<?php
    }
?>
            </figure>
            <p><?= $product_details['description'] ?></p>
            <form>
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                
                <input type="hidden" name="product_id" value="<?= $product_details['id'] ?>">
<?php
    if($this->session->userdata('user_id') != null){
?>
                <span orig-price="<?= $product_details['price'] ?>">(₱<?= $product_details['price'] ?>)</span>
                <input type="number" name="quantity" value="1" min="1">
                <input type="submit" value="Buy" />
<?php
    }else{
?>
                <a href="/users/login" id="login">Login to buy</a>
<?php
    }
?>

            </form>
            <em>Item added to the cart!</em>
        </main>

        <!-- Relate Products -->
        <footer>
            <h2>Similar Items</h2>
<?php
    foreach($similar_products as $similar_product){
        $images = json_decode($similar_product['images']);
?>
            <figure>
                <a href="/products/show/<?= $similar_product['id'] ?>">
                    <img src="/assets/img/products/<?= $similar_product['id'] ?>/<?= $images->main ?>"/>
                    <p>₱<?= $similar_product['price'] ?></p>
                    <figcaption><?= $similar_product['name'] ?></figcaption>
                </a>
            </figure>
<?php
    }
?>
        </footer>

    </body>
</html>