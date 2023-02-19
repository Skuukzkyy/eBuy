<?php
    for ($i = ($page_number - 1) * 10; $i < $page_number * 10; $i++) { 
        if($i == count($products)){
            break;
        }
        $images = json_decode($products[$i]['images']);
?>
                <tr>
                    <td><img src="/assets/img/products/<?= $products[$i]['id'] ?>/<?= $images->main ?>"></td>
                    <td><?= $products[$i]['id'] ?></td>
                    <td><?= $products[$i]['name'] ?></td>
                    <td><?= $products[$i]['inventory_count'] ?></td>
                    <td><?= $products[$i]['quantity_sold'] ?></td>
                    <td> 
                        <button id="edit">edit</button>
                        <button id="delete" title="Magnifying Glass" action="./delete/1">delete</a>
                    </td>
                </tr>
<?php
    }
?>