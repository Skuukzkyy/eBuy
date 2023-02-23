$(document).ready(function (){

    $(document).on('click', '#same_as_shipping', function(){
        var shipping_form = $('#default_shipping').serializeArray();
        shipping_form.forEach(function(element){
            var name = element['name'];
            var value = $('#default_shipping').children("[name = " +name+ "]").val();
            $('#default_billing').children("[name = " +name+ "]").val(value);
        });
        return false;
    });

    $(document).on('click', '#same_as_billing', function(){
        console.log(123)
        var billing_form = $('#default_billing').serializeArray();
        billing_form.forEach(function(element){
            var name = element['name'];
            var value = $('#default_billing').children("[name = " +name+ "]").val();
            $('#default_shipping').children("[name = " +name+ "]").val(value);
        });
        return false;
    });
});