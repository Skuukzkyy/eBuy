<?php
    for ($i=0; $i < count($products) / 10; $i++) { 
?>
        <a href="<?= $i +1 ?>"><?= $i +1 ?></a>
<?php
    }
?>
        <a class="page" href="<?= ($page_number > count($products) / 10) ? 1 : $page_number + 1 ?>">&#8594;</a>