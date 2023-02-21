                        <!-- for emptty category selection -->
                        <section>
                            <input class="category" type="text" value="" readonly/>
                        </section>
<?php
    foreach($categories as $category){
?>
                            <section>
                                <input class="category" type="text" value="<?= $category['name'] ?>" data-category-id="<?= $category['id'] ?>" readonly/>
                                <img class="edit" src="/assets/img/pencil.png"/>
                                <img class="remove" title="Hardware" src="/assets/img/trash-can.png"/>
                            </section>
<?php
    }
?>
