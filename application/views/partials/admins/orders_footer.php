<?php
    for ($i=0; $i < count($orders) / 10; $i++) { 
?>
            <a href="<?= $i +1 ?>"><?= $i +1 ?></a>
<?php
    }
?>
            <a class="page" href="<?= ($page_number > count($orders) / 10) ? 1 : $page_number + 1 ?>">&#8594;</a>