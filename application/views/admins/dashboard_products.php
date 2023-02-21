<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Jerick P. Arlantico">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link href = "https://code.jquery.com/ui/1.10.4/themes/overcast/jquery-ui.css" rel="stylesheet">
        <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="/assets/js/admins/dashboard_products.js"></script>
        <link rel="stylesheet" href="/assets/css/dashboard-products-style.css"/>
        <link rel="stylesheet" href="/assets/css/header.css"/>
    </head>
    <body> 

        <div class="error"><?= $this->session->flashdata('error_message') ?></div>
        <div class="success"><?= $this->session->flashdata('success_message') ?></div>

        <!-- edit -->
        <div class="form-dialog" id="form-edit-dialog">      
        </div>

<!-- add -->
        <div class="form-dialog" id="form-add-dialog">
            <div class="loader-dialog">
                <img src="/assets/img/ajax-loader.gif"/>
            </div>
            <form action="/admins/create" method="POST" id="add_new_product" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <label for="name">Name:</label>
                <input type="text" name="name"/>
        
                <label for="description">Description:</label>
                <textarea name="description"></textarea>
                
                <label for="categories">Categories:</label>
                <details>
                    <summary class="add_category">Select Category:<span>▼</span></summary>
                    <div class="categories_container">
                    </div>
                </details>
                <label for="new_category">or add new category:</label>
                <input type="text" name="category" id="category"/>
        
                <label>Price:</label><input type="number" name="price">
                <label>Stock:</label><input type="number" name="stock">

                <!-- upload image for new product -->
                <p>Images:</p>
                <label for="add_product_images">Upload</label>        
                <input type="file" name="images[]" id="add_product_images" multiple="multiple" />
                <ul></ul>

                <button type="button" id="cancel">Cancel</button>
                <button type="button" id="preview">Preview</button>
                <input type="submit" value="Add"/>
            </form>
        </div>
        <h1>Product dashboard</h1>
        <nav>
            <div>
                <form action="/admins/load_products" method="POST" id="search">
                    <img src='./img/magnifying_glass.png' />
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <input type="hidden" name="page_number" id="page_number" value = 1>
                    <input type="search" name="search_keyword" id="search_keyword" placeholder="search">
                </form>
            </div>
            <button>Add New Product</button>
        </nav>
        <table>
            <thead>
                <tr>
                    <td>Picture</td>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Inventory Count</td>
                    <td>Quantity Sold</td>
                    <td>Action</td>
                </tr>                
            </thead>
            <tbody>
            </tbody>
        </table>
        <footer>
        </footer>
    </body>
</html>