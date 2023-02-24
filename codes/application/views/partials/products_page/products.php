<?php
    for ($i = ($page_number -1) * 14; $i < $page_number * 14; $i++) { 
        if($i >= count($products)){
            break;
        }
?>
                <figure>
                    <a href="/products/show/<?= $products[$i]['id'] ?>">
<?php                   $images = json_decode($products[$i]['images']); ?>
                        <img src="/assets/img/products/<?= $products[$i]['id'] ?>/<?= $images->main ?>"/>
                    </a>
                    <figcaption><p><?= $products[$i]['name'] ?></p></figcaption>
                    <p class="price">₱<?= $products[$i]['price'] ?></p>
                </figure>
<?php
            }
?>


                <footer>
<?php
    for ($i = 0; $i < count($products) / 14; $i++) { 
?>
                    <a class="page" href="<?= $i + 1 ?>"><?= $i + 1 ?></a>
<?php
    }
?>
                    <a class="page" href="<?= ($page_number > count($products) / 14) ? 1 : $page_number + 1 ?>">&#8594;</a>
                </footer>