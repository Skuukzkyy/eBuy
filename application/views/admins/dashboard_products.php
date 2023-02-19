<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href = "https://code.jquery.com/ui/1.10.4/themes/overcast/jquery-ui.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="/assets/js/admins/dashboard_products.js"></script>
        <link rel="stylesheet" href="/assets/css/dashboard-products-style.css"/>
        <link rel="stylesheet" href="/assets/css/header.css"/>
    </head>
    <body> 
        <!-- edit -->
        <div class="form-dialog" id="form-edit-dialog">
            <div class="loader-dialog">
                <img src="img/ajax-loader.gif"/>
            </div>
            <form action="#" method="POST">

                <label for="name">Name:</label>
                <input type="text" name="name" value="Magnifying Glass"/>
        
                <label for="description">Description:</label>
                <textarea name="description">Small size</textarea>
                
                <label for="categories">Categories:</label>
                <details>
                    <summary>Tools<span>▼</span></summary>
                    <div>
                        <section>
                            <input class="category" type="text" value="Hardware" readonly/>
                            <img class="edit" src="img/pencil.png"/>
                            <img class="remove" title="Hardware" src="img/trash-can.png"/>
                        </section>
                        <section>
                            <input class="category" type="text" value="Tactical" readonly/>
                            <img class="edit" src="img/pencil.png"/>
                            <img class="remove" title="Tactical" src="img/trash-can.png"/>
                        </section>
                    </div>
                </details>
        
                <label for="new_category">or add new category:</label>
                <input type="text" name="new_category"/>
        
                <p>Images:</p>
                <label for="upload">Upload</label>        
                <input type="file" id="upload" hidden/>
                
                
                <ul id="sortable">
                    <li class="ui-state-default">
                        <img src="img/draggable.png"/>
                        <img src="img/magnifying_glass.png"/>
                        <p>img1.png</p>
                        <img class="remove" title="img1.png" src="img/trash-can.png"/>
                        <input type="checkbox" name="is_main">
                        <label for="is_main">main</label><br>
                    </li>
                    <li class="ui-state-default">
                        <img src="img/draggable.png"/>
                        <img src="img/magnifying_glass.png"/>
                        <p>img2.png</p>
                        <img class="remove" title="img2.png" src="img/trash-can.png"/>
                        <input type="checkbox" name="is_main">
                        <label for="is_main">main</label><br>
                    </li>
                    <li class="ui-state-default">
                        <img src="img/draggable.png"/>
                        <img src="img/magnifying_glass.png"/>
                        <p>img3.png</p>
                        <img class="remove" title="img3.png" src="img/trash-can.png"/>
                        <input type="checkbox" name="is_main">
                        <label for="is_main">main</label><br>
                    </li>
                </ul>
                <button type="button" id="cancel">Cancel</button>
                <button type="button" id="preview">Preview</button>
                <input type="submit" value="Update"/>
            </form>
        </div>

<!-- add -->
        <div class="form-dialog" id="form-add-dialog">
            <div class="loader-dialog">
                <img src="img/ajax-loader.gif"/>
            </div>
            <form action="#" method="POST">
                <label for="name">Name:</label>
                <input type="text" name="name"/>
        
                <label for="description">Description:</label>
                <textarea name="description"></textarea>
                
                <label for="categories">Categories:</label>
                <details>
                    <summary>Tools<span>▼</span></summary>
                    <div>
                        <section>
                            <input class="category" type="text" value="Hardware" readonly/>
                            <img class="edit" src="img/pencil.png"/>
                            <img class="remove" title="Hardware" src="img/trash-can.png"/>
                        </section>
                        <section>
                            <input class="category" type="text" value="Tactical" readonly/>
                            <img class="edit" src="img/pencil.png"/>
                            <img class="remove" title="Tactical" src="img/trash-can.png"/>
                        </section>
                    </div>
                </details>
        
                <label for="new_category">or add new category:</label>
                <input type="text" name="new_category"/>
        
                <p>Images:</p>
                <label for="upload">Upload</label>        
                <input type="file" id="upload" hidden/>
                <ul></ul>

                <button type="button" id="cancel">Cancel</button>
                <button type="button" id="preview">Preview</button>
                <input type="submit" value="Update"/>
            </form>
        </div>
        <h1>Product dashboard</h1>
        <nav>
            <div>
                <form action="/admins/load_products" method="POST" id="search">
                    <img src='./img/magnifying_glass.png' />
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
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