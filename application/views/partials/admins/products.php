<?php
    for ($i = ($page_number - 1) * 9; $i < $page_number * 9; $i++) { 
        if($i >= count($products)){
            break;
        }
        $images = json_decode($products[$i]['images']);
?>
                <tr>
                    <td><img src="/assets/img/products/<?= $products[$i]['id'] ?>/<?= $images->main ?>"></td>
                    <td><?= $products[$i]['id'] ?></td>
                    <td class="product_name"><?= $products[$i]['name'] ?></td>
                    <td><?= $products[$i]['inventory_count'] ?></td>
                    <td><?= $products[$i]['quantity_sold'] ?></td>
                    <td> 
                        <button id="edit" data-product-id="<?= $products[$i]['id'] ?>">edit</button>
                        <button id="delete" title="<?= $products[$i]['name'] ?>" action="/admins/delete_product/<?= $products[$i]['id'] ?>">delete</a>
                    </td>
                </tr>
<?php
    }
?>
