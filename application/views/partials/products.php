<?php
    foreach($products as $product){
?>
                <figure>
                    <a href="./product_details.html">
<?php                   $images = json_decode($product['images']); ?>
                        <img src="/assets/img/products/<?= $product['id'] ?>/<?= $images->main ?>"/>
                        <p><?= $product['price'] ?></p>
                        <figcaption><?= $product['name'] ?></figcaption>
                    </a>
                </figure>
<?php
            }
?>