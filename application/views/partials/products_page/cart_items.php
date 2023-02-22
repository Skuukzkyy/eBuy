            <table>
                <thead>
                    <tr>
                        <td>Item</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
                    </tr>                
                </thead>
                <tbody>
<?php
    if($cart_items == null){
?>
                    <tr><td colspan=4>Cart is empty</td></tr>
<?php
    }
    $total = 0;
    foreach($cart_items as $item){
        $total += $item['product_price'] * $item['quantity'];
?>
                    <tr>
                        <td><?= $item['product_name'] ?></td>
                        <td>₱<?= $item['product_price'] ?></td>
                        <td>
                            <form id="update_cart" action="/users/update_cart_quantity" method="POST">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                <input class="cart_item_quantity" name="quantity" type="number" min="1" value="<?= $item['quantity'] ?>"/> 
                                <img class="remove_from_cart" data-product-name="<?= $item['product_name'] ?>" data-product-id="<?= $item['product_id'] ?>" src="/assets/img/trash-can.png"/>
                            </form>
                        </td>
                        <td>₱<?= $item['product_price'] * $item['quantity']?></td>
                    </tr>
<?php
    }
?>
                </tbody>
            </table>
            <p>Total: ₱<?= $total ?></p>
            <button type="button" onclick="location.href='/';">Continue Shopping</button>