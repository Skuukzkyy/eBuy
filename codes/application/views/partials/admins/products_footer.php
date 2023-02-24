<?php
    for ($i=0; $i < count($products) / 9; $i++) { 
?>
        <a href="<?= $i +1 ?>"><?= $i +1 ?></a>
<?php
    }
?>
        <a class="page" href="<?= ($page_number > count($products) / 9) ? 1 : $page_number + 1 ?>">&#8594;</a>