$(document).ready(function () {
    $("#order").click(function () {
        var data_id = $(this).attr("data_id");
        var data = {id: data_id};

        $.ajax({
            url: "?mod=order&action=update",
            method: "POST",
            data: data,
            dataType: "text",
            success: function (data) {
                alert(data);
            }
        })
    })
})