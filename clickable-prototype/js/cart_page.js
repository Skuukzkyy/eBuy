$(document).ready(function() {
    $(".loader-dialog").hide();
    $("#message-dialog").dialog({
        autoOpen: false
    });

    $(document).on('change', '.cart_item_quantity', function(){
        var form = $(this).parent()
        console.log(123);
        show_hide_loader();
        // load_cart_items();
        // $.post('/users/update_cart_quantity', $(form).serialize(), function(res){
        //     show_hide_loader();
        //     load_cart_items();
        // });
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

    // checkout forrm submit
    $(document).on('click', '#pay_button', function(){
        var total_cost = $('#total_cost').val();
        $.post('/users/checkout', $('form#checkout').serialize(), function(res){
            if(res == 'success'){
                pay(total_cost);
                console.log(res);
            }else{
                console.log(res)
                location.reload();
            }
        });
        return false;
    });

    load_cart_items();
});

function pay(amount) {
    var handler = StripeCheckout.configure({
        key: 'pk_test_51MeZJdEYWVYzumRAbGPnXNmkn1J1cdlXJqtIpQd37UbcPwMdA5GsBkxN3BS3hVJa9F9DbzT9TKuRZhR9KlT6gwpZ00KpJjJHYt', // your publisher key id
        locale: 'auto',
        token: function (token) {
        // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
            console.log('Token Created!!');
            console.log(token)
            var csrfName = $('.csrf').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = $('.csrf').val(); // CSRF hash
            $('#token_response').html(JSON.stringify(token));
            $.ajax({
                url:"/stripe/payment",
                method: 'post',
                data: { tokenId: token.id, amount: amount, [csrfName]: csrfHash },
                dataType: "json",
                success: function( response ) {
                    location.reload();
                }
            })
        }
    });
    handler.open({
        name: 'Payment for order',
        description: 'Total: ₱'+amount,
        amount: 'PAY'
    });
}

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