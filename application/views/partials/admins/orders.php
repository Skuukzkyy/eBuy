<?php
    foreach($orders as $order){
?>
                <tr>
                    <td><a href="/orders/show/<?= $order['id'] ?>"><?= $order['id'] ?></a></td>
                    <td><?= $order['first_name']. ' ' .$order['last_name'] ?></td>
                    <td><?= date('m/d/Y', strtotime($order['created_at'])) ?></td>
<?php                
                    $billing_address = json_decode($order['billing_address'], TRUE);
?>
                    <td><?= $billing_address['billing_address']['address'] ?></td>
                    <td>₱<?= $order['total_cost'] ?></td>
                    <td>
                        <select title="<?= $order['id'] ?>" name="status" id="status" <?= ($order['status'] == 2 || $order['status'] == 0) ? "disabled" : "" ?>>
                        <!-- bawal na ibahin pag cancelled na or sihpped -->
                            <option value="1" <?= ($order['status'] == 1) ? "selected disabled" : "" ?>>Order in process</option>
                            <option value="2" <?= ($order['status'] == 2) ? "selected disabled" : "" ?>>Shipped</option>
                            <option value="0" <?= ($order['status'] == 0) ? "selected disabled" : "" ?>>Cancelled</option>
                        </select>
                    </td>
                </tr>
<?php
    }
?>