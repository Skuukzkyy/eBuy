$(document).ready(function(){

    $(document).on('submit', 'form', function(){
        $.post($(this).attr('action'), $(this).serialize(), function(res){
            $('section#products').html(res);
        });

        return false;
    });

    $(document).on('change', '#sorted_by', function(){
        $(this).parent().submit();
    })

    $('form#sort').submit();
});