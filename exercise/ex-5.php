<?php
#1.tạo mảng lưu các số lẻ từ 3 -> 150
$list_odd = array();
for ($i = 3; $i <= 150; $i++) {
    if ($i % 2 != 0) {
        $list_odd[] = $i;
    }
}
//echo "<pre>";
//print_r($list_odd);
//echo "</pre>";
#2.Tạo mảng đa chiều quản lí các bài viết trong wedsite tin tức
$list_news = array(
    1 => array(
        "id" => 1,
        "title" => "Văn Toàn hồi phục thần tốc trước thềm trận đấu với Malaysia",
        "detail" => "Dân trí Thông tin mới nhất từ ban huấn luyện đội tuyển Việt Nam, tiền đạo Văn Toàn đang hồi phục rất nhanh và có thể ra sân trong trận gặp Malaysia tối mai, 11/6.
Sau trận thắng Indonesia 4-0, tiền vệ Tuấn Anh và tiền đạo Văn Toàn đã được đưa đi chụp MRI để kiểm tra tình trạng chấn thương. Tuấn Anh bị đau cổ chân sau một pha vào bóng thô bạo của một cầu thủ Indonesia, còn Văn Toàn bị đau ở vai và hông.

Căn cứ kết quả chụp phim, các bác sỹ đội tuyển đã có giải pháp điều trị hồi phục phù hợp nhất cho hai cầu thủ này. Theo đánh giá ban đầu, Tuấn Anh và Văn Toàn may mắn không bị tổn thương về xương, nên sẽ không mất nhiều thời gian để trở lại tập luyện bình thường."
    ),
    2 => array(
        "id" => 2,
        "title" => "Bí thư Tỉnh ủy Bình Dương không được xác nhận tư cách đại biểu Quốc hội",
        "detail" => "Dù là người trúng cử đại biểu Quốc hội khóa XV với tỷ lệ phiếu bầu cao nhất trong số các đại biểu của Bình Dương, Bí thư Tỉnh ủy tỉnh này - ông Trần Văn Nam không được xác nhận tư cách đại biểu. Đây là thông tin được khẳng định tại cuộc họp báo công bố Nghị quyết của Hội đồng Bầu cử quốc gia về kết quả bầu cử và danh sách những người trúng cử ĐBQH khóa XV."
    ),
    3 => array(
        "id" => 3,
        "title" => "Tối 10/6, 61 ca Covid-19, TPHCM tiếp tục ghi nhận trường hợp mắc mới",
        "detail" => "Dân trí Thông tin mới nhất từ ban huấn luyện đội tuyển Việt Nam, tiền đạo Văn Toàn đang hồi phục rất nhanh và có thể ra sân trong trận gặp Malaysia tối mai, 11/6.
Sau trận thắng Indonesia 4-0, tiền vệ Tuấn Anh và tiền đạo Văn Toàn đã được đưa đi chụp MRI để kiểm tra tình trạng chấn thương. Tuấn Anh bị đau cổ chân sau một pha vào bóng thô bạo của một cầu thủ Indonesia, còn Văn Toàn bị đau ở vai và hông.

Căn cứ kết quả chụp phim, các bác sỹ đội tuyển đã có giải pháp điều trị hồi phục phù hợp nhất cho hai cầu thủ này. Theo đánh giá ban đầu, Tuấn Anh và Văn Toàn may mắn không bị tổn thương về xương, nên sẽ không mất nhiều thời gian để trở lại tập luyện bình thường."
    )
);

#3.Tạo mảng đa chiều quản lí các sản phẩm trong wedsite bán hàng
$list_product = array(
    1 => array(
        "id" => 1,
        "title" => "Máy quạt thông minh",
        "price" => "500000đ",
    ),
    2 => array(
        "id" => 2,
        "title" => "Máy lạnh thông minh",
        "price" => "200000đ",
    ),
    3 => array(
        "id" => 3,
        "title" => "Điện thoại thông minh",
        "price" => "50000000đ",
    )
);

function show_array($data){
    if(is_array($data)){
        echo "pre";
        print_r($data);
        echo "/pre";
    }
}
?>
<html>
    <head>
        <title>hiển thị thông tin </title>
    </head>
    <body>
        <!--hiển thị danh sách bài viết--> 
        <ul class="list_news">
            <?php
            foreach ($list_news as $item) {
                ?>
                <li style="display: flex;margin: 1rem">
                    <a href="">
                        <img src="https://icdn.dantri.com.vn/zoom/360_240/2021/06/10/img2569-crop-1623316103214.jpeg" alt="">
                    </a>
                    <div class="content" style="max-width: 40%;margin-left: 1rem">
                        <a href=""><h3><?php echo $item["title"]; ?></h3></a>
                        <p><?php echo $item["detail"]; ?></p>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
        <!--hiển thị danh sách sản phẩm--> 
        <?php
        if (!empty($list_product)) {
            ?>
            <ul style="list-style: none;display: flex">
                <?php
                foreach ($list_product as $products) {
//                    show_array($products)
                    ?>
                    <li style="text-align: center">
                        <a href=""><img src="https://salt.tikicdn.com/cache/280x280/ts/product/08/6c/82/d6057bb83c24745708edcfbe4ddb32d2.jpg"></a><br>
                        <a href=""><?php echo $products["title"]; ?></a><br>
                        <a href=""><?php echo $products["price"]; ?></a><br>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php
        } else {
            ?>
            <p>mảng không có thông tin</p>
            <?php
        }
        ?>
    </body>
</html>
