<?php 
    $product_images = json_decode($product_details['images']); 
    $product_id = $product_details['id'];
?>

<div class="loader-dialog">
                <img src="/assets/img/ajax-loader.gif"/>
            </div>
            <form action="/admins/update_product/<?= $product_id ?>" method="POST" id="edit_product">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" id="csrf"/>
                <input type="hidden" name="product_id" id="product_id" value="<?= $product_details['id'] ?>">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?= $product_details['name'] ?>"/>
        
                <label for="description">Description:</label>
                <textarea name="description"><?= $product_details['description'] ?></textarea>
                
                <label for="categories">Categories:</label>
                <details>
                    <summary class="add_category"><?= $product_details['category'] ?><span>▼</span></summary>
                    <div class="categories_container">
                    </div>
                </details>
        
                <label for="new_category">or add new category:</label>
                <input type="text" name="category" id="category" value="<?= $product_details['category_id'] ?>"/>
        
                <label>Price:</label><input type="number" name="price" value="<?= $product_details['price'] ?>">
                <label>Stock:</label><input type="number" name="stock" value="<?= $product_details['inventory_count'] ?>">

                <p>Images:</p>
                <label for="update_product_images">Upload</label>        
                <input type="file" name="images[]" id="update_product_images" multiple="multiple" />
                <!-- <input type="file" id="upload" hidden/> -->
                
                <!-- displays product images -->
                <ul id="sortable">
                    <!-- main image -->
                    <li class="ui-state-default">
                        <img src="/assets/img/draggable.png"/>
                        <img data-file-name="<?= $product_images->main ?>" class="product_image" src="/assets/img/products/<?= $product_id ?>/<?= $product_images->main ?>"/>
                        <p><?= $product_images->main ?></p>
                        <img class="remove_image" src="/assets/img/trash-can.png"/>
                        <input type="radio" name="main" value="<?= $product_images->main ?>" checked required>
                        <label>main</label><br>
                    </li>
                    <!-- other images -->
<?php
    foreach($product_images->others as $sub_image){
?>
                    <li class="ui-state-default">
                        <img src="/assets/img/draggable.png"/>
                        <img data-file-name="<?= $sub_image ?>" class="product_image" src="/assets/img/products/<?= $product_id ?>/<?= $sub_image ?>"/>
                        <p><?= $sub_image ?></p>
                        <img class="remove_image" src="/assets/img/trash-can.png"/>
                        <input type="radio" name="main" value="<?= $sub_image ?>">
                        <label>main</label><br>
                    </li>
<?php
    }
?>
                </ul>
                <button type="button" id="cancel">Cancel</button>
                <button type="button" id="preview">Preview</button>
                <input type="submit" value="Update"/>
            </form>