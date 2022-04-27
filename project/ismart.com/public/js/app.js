//pagging blog
$(document).ready(function () {
    function get_post(page_num) {
        var data = { page_num: page_num };
        console.log(data);
        $.ajax({
            url: "?mod=blog&controller=index&action=pagination_post",
            method: "POST",
            data: data,
            dataType: 'json',
            success: function (data) {
                $('#blog').html(data.output);
            },
            error: function (xhr, ajaxoptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        })
    };

    $(document).on("click", ".num-page-blog", function () {
        var page_num = $(this).text();
        get_post(page_num);
    });
});

//pagging product
$(document).ready(function () {
    function get_data(cat_id, page_num) {
        var arrange = $("#filter-arrange").find(":selected").val();
        var data = { page_num: page_num, cat_id: cat_id, arrange: arrange };
        console.log(data);

        $.ajax({
            url: "?mod=product&controller=index&action=product",
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                $('#' + cat_id).html(data.output);
            },
            error: function (xhr, ajaxoptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        })
    }
    // get_data();
    $(document).on("click", ".num-page", function () {
        var cat_id = $(this).attr("cat-id");
        var page_num = $(this).text();
        get_data(cat_id, page_num);
    });
});

// pagination search
$(document).ready(function () {
    function get_datas(page_num, cat_id, value){
        var arrange = $("#filter-arrange").find(":selected").val();
        var data = {page_num: page_num, cat_id: cat_id, value: value, arrange: arrange};
        console.log(data);
        $.ajax({
            url: '?mod=home&controller=index&action=pagination_search',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                $('#'+cat_id).html(data.result_search);
            },
            error: function (xhr, ajaxoptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
        });
    };
    $(document).on("click", ".num-page-search", function () {
        var cat_id = $(this).attr('cat-id');
        var page_num = $(this).text();
        var value = $(this).attr('value');
        get_datas(page_num, cat_id, value);
    });
});

// pagination cat
$(document).ready(function () {
    function feach_data(page_num) {
        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function () {
                filter.push($(this).val());
            });
            return filter;
        };


        var price = get_filter("filter-price");
        var brand = get_filter("filter-brand");
        var cat_id = $("h3#cat-title").attr("cat-id");
        var arrange = $("#filter-arrange").find(":selected").val();
        var data = { page_num: page_num, price: price, cat_id: cat_id, brand: brand, arrange: arrange };
        console.log(data);

        $.ajax({
            url: "?mod=product&controller=index&action=pagination_cat",
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                $("#result-product-cat").html(data.output);
                $("#num-filter").text(data.num_filter);
                $("#num-page").text(data.num_page);

            },
            error: function (xhr, ajaxoptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
        });
    }

    // ferch_data();
    $(document).on("click", ".common_selector", function () {
        var page_num = $(this).text();
        feach_data(page_num);
    });
});

//cart ajax
$(document).ready(function () {
    $(".num-order").change(function () {
        var id = $(this).attr("data_id");
        var qty = $(this).val();
        var data = { id: id, qty: qty };
        console.log(data);

        $.ajax({
            url: "?mod=cart&action=ajax_cart",
            method: "POST",
            data: data,
            dataType: 'json',
            success: function (data) {
                $('.num-order').html(data.num_order);
                $('#total-' + id).html(data.sud_total);
                $('#total-price span').html(data.total);
            },
            error: function (xhr, ajaxoptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
        });
    })
})

//select district
$(document).ready(function () {
    $(".province").change(function () {
        var province = $(this).find(":selected").val();
        var data = { province: province };
        console.log(data);
        $.ajax({
            url: "?mod=cart&action=select_district",
            method: "POST",
            data: data,
            dataType: 'text',
            success: function (data) {
                $(".district").html(data);
            },
            error: function (xhr, ajaxoptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
        });
    })
})

//select commune
$(document).ready(function () {
    $(".district").change(function () {
        var district = $(this).find(":selected").val();
        var data = { district: district };
        console.log(data);
        $.ajax({
            url: "?mod=cart&action=select_commune",
            method: "POST",
            data: data,
            dataType: 'text',
            success: function (data) {
                $(".commune").html(data);
            },
            error: function (xhr, ajaxoptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
        });
    })
})


