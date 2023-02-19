<?php
    for ($i=0; $i < count($products) / 10; $i++) { 
?>
        <a href="<?= $i +1 ?>"><?= $i +1 ?></a>
<?php
    }
?>
        <a href="#">&#8594;</a>