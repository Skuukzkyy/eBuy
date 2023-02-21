$(document).ready(function(){

    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();

    $("#form-edit-dialog").dialog({
        autoOpen: false,
        title: "Edit Product",
        position: { my: "center top", at: "center top", of: window }

    });
    $("#form-add-dialog").dialog({
        autoOpen: false,
        title: "Add new Product",
        position: { my: "center top", at: "center top", of: window }
    });

    function show_hide_loader() {
        $(".loader-dialog").show(); // Show loading image
            setTimeout(function(){ 
                $(".loader-dialog").hide(); // Hide loading image
            }, 200);
    }
    // for ajax loding products
    $('#search_keyword').keyup(function(){
        $('#page_number').val(1);
        $(this).parent().submit();
    });

    $('form#search').submit(function(){
        $.post('/admins/load_products', $(this).serialize(), function(res){
            // console.log(res)
            var response = JSON.parse(res);
            $('tbody').html(response.products);
            $('footer').html(response.pages);
            $('.categories_container').html(response.categories);
        });
        return false;
    });
    $('form#search').submit(); //submit form pagkaload ng page para mag load lahat ng image

    // pagination
    $(document).on('click', 'footer a', function(){
        $('#page_number').val($(this).attr('href'));
        $('form#search').submit();
        return false;
    });

    //form showing modal on click
    $("nav button").on("click", function(){
            $("#form-add-dialog").dialog("open");
    });

    //edittable ng category
    $(document).on('click', "form img.edit", function(){
        $('input.category').attr('readonly',true);
        $(this).siblings("input").removeAttr("readonly");
        $(this).siblings("input").focus();
    });

    $(document).on('blur', 'input.category', function(){
        $(this).attr('readonly',true);
    });

    //update category
    $(document).on('keyup', 'form input.category', function(){
        var category = $(this).val();
        var data = {'category': category, 'category_id': $(this).attr('data-category-id')}
        $.get('/admins/update_category', data, function(res){
            $('summary.add_category').html(category + '<span>▼</span>');
            show_hide_loader();
        });
    });

    // delete category
    $(document).on('click', "form img.remove", function(){
        var category_id = $(this).siblings('input.category').attr('data-category-id');
        $.get('/admins/delete_category/'+category_id, function(res){
            $('form#search').submit();
        })
        .fail(function(error){
            $('div.error').text('Cannot delete category that basta may benta pa sa category na ito');
        });
    });

    //pindutan ng update/add category
    $(document).on('click', "form input.category", function(){
            $('summary.add_category').html($(this).val() + '<span>▼</span>');
            // $('summary.add_category').trigger('click');

            if($(this).val() != ""){
                $('form #category').val($(this).attr('data-category-id'));
                $('form #category').attr('readonly',true);
            }else{
                $('form #category').attr('readonly',false);
                $('form #category').val('');
            }
    });

    // delete product
    $(document).on('click', 'button#delete', function(){
        if (confirm($(this).attr('title') + " will be deleted. Click to confirm.")) {
            $.get($(this).attr('action'), function(res){
                $('form#search').submit();
            });

            alert($(this).attr('title')+" is now deleted.");
        }
    });

    // show dialog for edit product
    $(document).on("click", "button#edit", function(){
            var product_id = $(this).attr('data-product-id');
            $.get('/admins/load_product_details/'+product_id, function(res){
                var response = JSON.parse(res);
                $('#form-edit-dialog').html(response.product_details);
                $('form#edit_product .categories_container').html(response.categories);
                ($('form#edit_product .add_category').html() != "") ? $('form #category').attr('readonly',true) : null;
                $( "#sortable" ).sortable();
            });
            $("#form-edit-dialog").dialog("open");
    });

    // remove product_image
    $(document).on('click', "form img.remove_image", function(){
        if (confirm($(this).siblings('p').text() + " will be deleted. Click to confirm.")) {
            $(this).parent().remove();
        }
    });

    // on upload ng file
    $(document).on('change', '#update_product_images', function(){
        var list_tags = $('form#edit_product').children('ul').children('li');
        var input_file = $(this);
        let files = input_file[0].files;
        // console.log(input_file);

        if(list_tags.length + files.length > 4){
            alert("You can only add 4 images to your product");
            return false;
        }
        var form_data = new FormData();
        form_data.append("name", "jerick");
        form_data.append("age", "21");
        // console.log(files.length)
        if (files[0] != undefined){
            for (var i = 0; i < files.length; i++) {
                var image = files[i];
                form_data.append("images[]", image);
            }
            // console.log(files);
        }
        form_data.append('csrf_test_name', $('#csrf').val());
        // ajax call  para maappend yung inupload na image sa html ng edit foorm
        $.ajax({
            type: "POST",
            url: '/admins/update_product_image/' +$('#product_id').val(),
            data: form_data,
            processData: false,
            contentType: false,     
            cache: false,
            success: function (res){
                var images = JSON.parse(res);
                console.log(images.names[0]);
                var html_img_string = '';
                for (var i = 0; i < images.names.length; i++) {
                    var image_name = images.names[i];
                    
                    html_img_string += "<li class=ui-state-default>";
                    html_img_string += "<img src=/assets/img/draggable.png>";
                    html_img_string += "<img data-file-name=" +image_name+ " class=product_image src=/assets/img/products/" +$('#product_id').val()+ "/" +image_name+ ">";
                    html_img_string += "<p>" +image_name+ "</p>";
                    html_img_string += "<img class=remove_image src=/assets/img/trash-can.png>";
                    html_img_string += "<input type=radio name=main value=" +image_name+ ">";
                    html_img_string += "<label>main</label><br>";
                    html_img_string += "</li>";
                }
                $('#sortable').append(html_img_string);
            }
        });
    });

    //Update product in modal
    $(document).on('submit', "form#edit_product", function(){
        // show_hide_loader();
        var list_tags = $(this).children('ul').children('li');
        // console.log(list_tags)
        for (let i = 0; i < list_tags.length; i++) {
            const li = list_tags[i];
            const image_name = $(li).children('img.product_image').attr('data-file-name');            
            console.log(image_name)
            
            $(this).append('<input type="hidden" name=new_images[] value=' +image_name+ '>');
        }
        return true;
    });
    //Cancel in product modal
    $(document).on('click', "button#cancel", function(){
        $(".form-dialog").dialog("close");
    });
    //Preview in product modal
    $(document).on('click', "button#preview", function(){
        window.open('product_details.html', '_blank');
    });

    //Product or Category delete
    // $(document).on('click', "button#delete, img.remove", function() {
        // if (confirm($(this).attr('title') + " will be deleted. Click to confirm.")) {
        //     alert($(this).attr('title')+" is now deleted.");
        // }
    // });
});