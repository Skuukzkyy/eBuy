<?php
    for ($i = ($page_number -1) * 21; $i < $page_number * 21; $i++) { 
        if($i >= count($products)){
            break;
        }
?>
                <figure>
                    <a href="/products/show/<?= $products[$i]['id'] ?>">
<?php                   $images = json_decode($products[$i]['images']); ?>
                        <img src="/assets/img/products/<?= $products[$i]['id'] ?>/<?= $images->main ?>"/>
                        <p><?= $products[$i]['price'] ?></p>
                        <figcaption><?= $products[$i]['name'] ?></figcaption>
                    </a>
                </figure>
<?php
            }
?>


                <footer>
<?php
    for ($i = 0; $i < count($products) / 21; $i++) { 
?>
                    <a class="page" href="<?= $i + 1 ?>"><?= $i + 1 ?></a>
<?php
    }
?>
                    <a class="page" href="<?= ($page_number > count($products) / 21) ? 1 : $page_number + 1 ?>">&#8594;</a>
                </footer>