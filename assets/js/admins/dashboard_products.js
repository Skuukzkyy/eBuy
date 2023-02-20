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
            }, 200);
    }
    // for ajax loding products
    // <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
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
        });
        return false;
    });
    $('form#search').submit();

    // pagination
    $(document).on('click', 'footer a', function(){
        $('#page_number').val($(this).attr('href'));
        $('form#search').submit();
        return false;
    });



    //form showing modal on click
    $("nav button").on("click", function() {
            $("#form-add-dialog").dialog("open");
    });

    //edit category
    $(document).on('click', "img.edit", function() {
        $(this).siblings("input").removeAttr("readonly");
        $(this).siblings("input").focus();
    });
    //update/add category
    $(document).on('click', "form#add_new_product input.category", function() {
            $('summary.add_category').html($(this).val() + '<span>▼</span>');
            // $('summary.add_category').trigger('click');

            if($(this).val() != ""){
                $('form#add_new_product #category').val($(this).attr('data-category-id'));
                $('form#add_new_product #category').attr('readonly',true);
            }else{
                $('form#add_new_product #category').attr('readonly',false);
                $('form#add_new_product #category').val('');
            }
            // show_hide_loader();
            // $("input.category").attr("readonly", "true");
    });


    $(document).on("click", "button#edit", function() {
            $("#form-edit-dialog").dialog("open");
    });

    //Update product in modal
    $(document).on('submit', "form", function() {
        show_hide_loader();
        // return false;
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