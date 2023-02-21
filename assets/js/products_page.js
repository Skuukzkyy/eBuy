$(document).ready(function(){

    $(document).on('submit', 'form#search', function(){
        var filter = $('form#search').serialize() + '&sorted_by=' + $('#sorted_by').val();
        $.post('/products/load_products',filter, function(res){
            $('section#products').html(res);
        });
        return false;
    });

    // sort and search
    $(document).on('change keyup', '#sorted_by, #search_keyword', function(){
        $('form#search input[name=page_number]').val("1");
        $('form#search').submit();
    });

    $('form#search').submit(); //submit at load to get all products

    //pagination
    $(document).on('click', 'footer a.page', function(){
        $('form#search input[name=page_number]').val($(this).attr('href'));
        $('form#search').submit();
        return false;
    });


    // category
    $(document).on('click', '.category', function(){
        $('form#search input[name=page_number]').val("1");
        var filter = $('form#search').serialize() + '&sorted_by=' + $('#sorted_by').val();
        var category_id = $(this).attr('href')
        filter += "&category_id="+category_id;
        $.post('/products/load_products', filter, function(res){
            $('section#products').html(res);
        });
        return false;
    });

});