$(document).ready(function () {
    
    load_orders();

    $(document).on('change', 'select#filter', function(){
        load_orders();
    });

    $(document).on('change', 'select#status', function(){
        if(confirm("Order #" +$(this).attr('title')+ " will be updated. This cannot be reverted. Click to confirm.")){
            $.get('/admins/update_order_status', {order_id: $(this).attr('title'), status: $(this).val()}, function(res){
                load_orders();
            });
        }
    });

    $(document).on('keyup', 'input#search_keyword', function(){
        load_orders();
    });
});

function load_orders(){
    $.get('/admins/filter_order', {search_keyword: $('input#search_keyword').val(),status: $('select#filter').find(":selected").val()}, function(res){
        $('tbody').html(res);
    });
}