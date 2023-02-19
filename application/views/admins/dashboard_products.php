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
        <link rel="stylesheet" href="/assets/css/dashboard-products-style.css"/>
        <link rel="stylesheet" href="/assets/css/header.css"/>
    </head>
    <script>
        $(document).ready(function() {
            $( "#sortable" ).sortable();
			$( "#sortable" ).disableSelection();

            $("#form-edit-dialog").dialog({
                autoOpen: false,
                title: "Edit Product - ID 2"
            });
            $("#form-add-dialog").dialog({
                autoOpen: false,
                title: "Add new Product"
            });

            function show_hide_loader() {
                $(".loader-dialog").show(); // Show loading image
                    setTimeout(function() { 
                        $(".loader-dialog").hide(); // Hide loading image
                    }, 1000);
            }
            //form modal
            $("button#edit").on("click", function() {
                    $("#form-edit-dialog").dialog("open");
            });
            $("nav button").on("click", function() {
                    $("#form-add-dialog").dialog("open");
            });
            //edit category
            $(document).on('click', "img.edit", function() {
                $(this).siblings("input").removeAttr("readonly");
            });
            //update/add category
            $(document).on('keyup', "input.category", function() {
                setTimeout(function() { 
                    show_hide_loader();
                    $("input.category").attr("readonly", "true");
                }, 2000);
            });
            //Update product in modal
            $(document).on('submit', "form", function() {
                show_hide_loader();
                return false;
            });
            //Cancel in product modal
            $(document).on('click', "button#cancel", function() {
                $(".form-dialog").dialog("close");
            });
            //Preview in product modal
            $(document).on('click', "button#preview", function() {
                window.open('product_details.html', '_blank');
            });
            //Product or Category delete
            $(document).on('click', "button#delete, img.remove", function() {
                if (confirm($(this).attr('title') + " will be deleted. Click to confirm.")) {
                    alert($(this).attr('title')+" is now deleted.");
                }
            });
        });
    </script>
    <body> 
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
 
        <nav>
            <div>
                <img src='./img/magnifying_glass.png' />
                <input type="search" name="search_keyword" placeholder="search">
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
                <tr>
                    <td><img src="img/magnifying_glass.png"></td>
                    <td>1</td>
                    <td>Magnifying Glass</td>
                    <td>201</td>
                    <td>1000</td>
                    <td> 
                        <button id="edit">edit</button>
                        <button id="delete" title="Magnifying Glass" action="./delete/1">delete</a>
                    </td>
                </tr>
                <tr>
                    <td><img src="img/magnifying_glass.png"></td>
                    <td>2</td>
                    <td>Magnifying Glass (lg)</td>
                    <td>450</td>
                    <td>600</td>
                    <td> 
                        <button id="edit">edit</button>
                        <button id="delete" title="Magnifying Glass (lg)" action="./delete/1">delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <footer>
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">&#8594;</a>
        </footer>
    </body>
</html>