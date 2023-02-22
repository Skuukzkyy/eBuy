$(document).ready(function() {
    $(".loader-dialog").hide();
    $("#message-dialog").dialog({
        autoOpen: false
    });
    $('#message-dialog').on('dialogclose', function(event) {
        location.href="order_history.html";
    });

    $(document).on('change', '.cart_item_quantity', function(){
        var form = $(this).parent()
        $.post('/users/update_cart_quantity', $(form).serialize(), function(res){
            show_hide_loader();
            load_cart_items();
        });
    });

    // remove item on sa  cart
    $(document).on('click', "img.remove_from_cart", function() {
        var product_id = $(this).attr('data-product-id');
        if (confirm($(this).attr('data-product-name') + " will be deleted. Click to confirm.")) {
            $.get('/users/delete_cart_item/'+product_id, '', function(res){
                console.log(res)
                show_hide_loader();
                load_cart_items();
                update_header();
            });
        }
    });

    $(document).on('click', "#pay_button", function() {
        $("#message-dialog").dialog("open");
        return false;
    });

    $(document).on('submit', 'form', function(){
        return false;
    });

    load_cart_items();
});

function load_cart_items(){
    $.get('/users/load_cart_items', function(res){
        $('section#cart_items_table').html(res);
    });
}

function update_header(){
    $.get('/users/update_header', '', function(res){
        console.log(res)
        $('#header').html(res);
    });
}

function show_hide_loader() {
    $(".loader-dialog").show(); // Show loading image
        setTimeout(function(){ 
            $(".loader-dialog").hide(); // Hide loading image
        }, 100);
}