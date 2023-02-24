<?php
    for ($i = ($page_number - 1) * 10; $i < $page_number * 10; $i++){
        if($i >= count($orders)){
            break;
        }
?>
                <tr>
                    <td><a href="/orders/show/<?= $orders[$i]['id'] ?>"><?= $orders[$i]['id'] ?></a></td>
                    <td><?= $orders[$i]['first_name']. ' ' .$orders[$i]['last_name'] ?></td>
                    <td><?= date('m/d/Y', strtotime($orders[$i]['created_at'])) ?></td>
<?php                
                    $billing_address = json_decode($orders[$i]['billing_address'], TRUE);
?>
                    <td><?= $billing_address['billing_address']['address']. ' ' .$billing_address['billing_address']['city'] ?></td>
                    <td>₱<?= $orders[$i]['total_cost'] ?></td>
                    <td>
                        <select title="<?= $orders[$i]['id'] ?>" name="status" id="status" <?= ($orders[$i]['status'] == 2 || $orders[$i]['status'] == 0) ? "disabled" : "" ?>>
                        <!-- bawal na ibahin pag cancelled na or sihpped -->
                            <option value="1" <?= ($orders[$i]['status'] == 1) ? "selected disabled" : "" ?>>Order in process</option>
                            <option value="2" <?= ($orders[$i]['status'] == 2) ? "selected disabled" : "" ?>>Shipped</option>
                            <option value="0" <?= ($orders[$i]['status'] == 0) ? "selected disabled" : "" ?>>Cancelled</option>
                        </select>
                    </td>
                </tr>
<?php
    }
?>