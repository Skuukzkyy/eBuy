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
        <header>
            <a href="#">eBuy</a>
        </header>
        <div id="image-preview-dialog">
            <img src="/assets/img/magnifying_glass.png">
        </div> 
        <main>
            <h1><?= $product_details['name'] ?></h1>
            <figure>
                <img class="mini-image" src="/assets/img/magnifying_glass.png">
                <img class="mini-image" src="/assets/img/magnifying_glass.png">
                <img class="mini-image" src="/assets/img/magnifying_glass.png">
                <img class="mini-image" src="/assets/img/magnifying_glass.png">
                <img class="mini-image" src="/assets/img/magnifying_glass.png">
            </figure>
            <p><?= $product_details['description'] ?></p>
            <form>
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                
                <input type="hidden" name="product_id" value="">

                <span orig-price="<?= $product_details['price'] ?>">(₱<?= $product_details['price'] ?>)</span>
                <input type="number" name="quantity" value="1" min="1">
                <input type="submit" value="Buy" />
            </form>
        </main>

        </footer>

    </body>
</html>