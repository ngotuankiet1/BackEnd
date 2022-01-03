$(document).ready(function (){
    $("#num_order").change(function(){
        var price = $("#price").text();
        var num_order = $("#num_order").val();
        var data = {price: price, num_order: num_order};
        $.ajax({
            url: "process.php",
            method: "POST",
            data: data,
//            dataType: 'json',
            dataType: 'text',
//            success: function(data) {
//                console.log(data);
//                alert(data.price);
//            }
            success: function(data) {
//                $("#total").text(data);
                $("#total").html("<strong>"+data+"</strong>");
            },
            error: function(xhr,ajaxOption,throwError){
                alert(xhr.status);
                alert(throwError);
            }
        })
    })
})