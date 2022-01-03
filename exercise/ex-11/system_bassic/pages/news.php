<?php
$info_news = array(
    "1" => array(
        "title" => "Bài viết của Tổng Bí thư là tác phẩm có ý nghĩa quan trọng",
        "content" => "Bài viết của Tổng Bí thư Ban Chấp hành Trung ương Đảng Cộng sản Việt Nam Nguyễn Phú Trọng: Một số vấn đề lý luận và thực tiễn về chủ nghĩa xã hội và con đường đi lên chủ nghĩa xã hội ở Việt Nam là tác phẩm có ý nghĩa hết sức quan trọng không chỉ đối với đất nước Việt Nam và Đảng Cộng sản Việt Nam, mà còn đối với những người cộng sản trên toàn thế giới.",
    ),
    "2" => array(
        "title" => "Năm tỉnh miền Tây yêu cầu người dân không ra đường sau 18h",
        "content" => "Ngày 27/7, UBND tỉnh Bến Tre có công văn về việc quy định khung giờ của một số hoạt động trong thời gian thực hiện giãn cách xã hội theo Chỉ thị 16.
Theo đó, UBND tỉnh Bến Tre quy định, khung giờ người dân không được ra đường (trừ trường hợp cấp cứu, đi mua thuốc trị bệnh, thi hành công vụ, chuyên chở hàng hóa thiết yếu… và các vấn đề cấp thiết khác) là từ 18h hôm trước đến 5h hôm sau.
Khung giờ đi chợ từ 6h - 10h và từ 14h - 17h hàng ngày. Các quy định trên được áp dụng toàn tỉnh, bắt đầu từ 6h ngày 28/7.
UBND tỉnh Bến Tre yêu cầu hệ thống chính trị, các tổ chức đoàn thể triển khai đi mua hàng hóa thiết yếu, thực phẩm giúp người dân để hạn chế tối đa việc đi lại.",
    ),
    "3" => array(
        "title" => "Hoàng Thị Duyên hoàn thành mức tạ 113 kg cử đẩy",
        "content" => "Izabella hoàn thành với tổng cử 205 kg
Izabella Yaylyan (Armenia) không thành công ở mức tạ 115 kg ở lần cử đẩy thứ 3. Cô kết thúc phần thi chung kết với tổng cử 205 kg, và không có cơ hội tranh huy chương.",
    ),
);
?>
<style>
    #content a{
        font-size: 20px;
        display: block;
        font-weight: bold;
        margin: 10px 0px;
    }
</style>
<div id="content">
    <?php foreach ($info_news as $item) { ?>
        <a href=""><?php echo $item['title']; ?></a>
        <p><?php echo $item['content']; ?></p>
    <?php } ?>
</div>