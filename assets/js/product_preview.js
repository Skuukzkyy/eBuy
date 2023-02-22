$(document).ready(function() {
    $("#image-preview-dialog").dialog({
        autoOpen: false,
        position: { my: "center top", at: "center top", of: window }
    });

    // image modal 
    $("img.mini-image").on("click", function() {
        $("#image-preview-dialog img").attr("src", $(this).attr("src"));
        $("#image-preview-dialog").dialog("open");
    });
    //auto-compute upon changing quantity
    $("input[type='number']").on("change", function() {
        originalPrice = $(this).siblings("span").attr("orig-price");
        $(this).siblings("span").text("(₱"+(originalPrice*$(this).val()).toFixed(2)+")");
    });
    //display notif after submission
    $(document).on('submit', 'form', function() {
        $.post('/products/add_to_cart', $(this).serialize(), function(res){
            if(res != 'success'){
                alert('Quantity must be greater than 0');
                return false;
            }
            $.get('/products/update_header', function(res){
                $('#header').html(res);
            });
            $("main em").fadeIn(200);
            $("main em").fadeOut(1000);
        });
        return false;
    });
});