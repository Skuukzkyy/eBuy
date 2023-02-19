$(document).ready(function(){

    $(document).on('submit', 'form', function(){
        $.post($(this).attr('action'), $(this).serialize(), function(res){
            // console.log(category_id);
            $('section#products').html(res);
        });

        return false;
    });

    $(document).on('change', '#sorted_by', function(){
        $(this).parent().submit();
    });

    $('form#sort').submit();

    $(document).on('click', '.category', function(){
        var filter = $('form#sort').serialize();
        var category_id = $(this).attr('href')
        filter += "&category_id="+category_id;

        $.post('/products/load_products', filter, function(res){
            $('section#products').html(res);
        });
        return false;
    });
});