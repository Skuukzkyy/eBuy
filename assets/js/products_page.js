$(document).ready(function(){

    $(document).on('submit', 'form#search', function(){
        var filter = $('form#search').serialize() + '&sorted_by=' + $('#sorted_by').val();
        $.post('/products/load_products',filter, function(res){
            console.log(res);
            $('section#products').html(res);
        });
        return false;
    });

    // sort and search
    $(document).on('change keyup', '#sorted_by, #search_keyword', function(){
        $('form#search').submit();
    });

    $('form#search').submit();

    // category
    $(document).on('click', '.category', function(){
        var filter = $('form#search').serialize() + '&sorted_by=' + $('#sorted_by').val();
        var category_id = $(this).attr('href')
        filter += "&category_id="+category_id;

        $.post('/products/load_products', filter, function(res){
            $('section#products').html(res);
        });
        return false;
    });

});