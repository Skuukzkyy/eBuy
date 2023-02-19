$(document).ready(function() {

    // for ajax loding products
    // <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
    $('#search_keyword').keyup(function(){
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
        var filter = $('form#search').serialize();
        filter += '&page_number=' + $(this).attr('href');
        $.post('/admins/load_products', filter, function(res){

            var response = JSON.parse(res);
            $('tbody').html(response.products);
            $('footer').html(response.pages);
        });
        return false;
    });


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