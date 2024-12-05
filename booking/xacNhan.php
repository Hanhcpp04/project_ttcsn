<?php
if (!isset($_GET['tour_id']) || empty($_GET['tour_id'])) {
    die('Thông tin tour không hợp lệ.');
}
session_start();

// Kiểm tra nếu thông tin đã được lưu trong session
$hoVaTen = isset($_SESSION['HoVaTen']) ? $_SESSION['HoVaTen'] : '';
$soDienThoai = isset($_SESSION['SDT']) ? $_SESSION['SDT'] : '';
$email = isset($_SESSION['Email']) ? $_SESSION['Email'] : '';
$diaChi = isset($_SESSION['DiaChi']) ? $_SESSION['DiaChi'] : '';

// Lấy giá trị price từ URL hoặc giá mặc định
$price = isset($_GET['price']) ? $_GET['price'] : 0;

// Loại bỏ phần thập phân nếu có (chỉ lấy phần nguyên)
$priceInt = (int) $price; // Chuyển đổi về kiểu số nguyên để loại bỏ phần thập phân

// Hiển thị giá trị nguyên
$formattedPrice = number_format($priceInt, 0, ',', ''); // Format số mà không có dấu phân cách

$user_id = $_SESSION['UserID'];

include("../layout/header.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XacNhan</title>
    <link rel="stylesheet" href="..//template/css/xacnhan.css">
<body>
    <form method="POST" action="process_booking_tour.php">
    <h2>Thông Tin Đặt Tour</h2>

<!-- Tour ID (ẩn) -->
<input type="hidden" name="tour_id" value="<?php echo $_GET['tour_id']; ?>">

<!-- Cột 1 -->
<div>
    <label for="">Tên chuyến đi:</label>
    <input type="text" id="tenchuyendi" name="tenchuyendi" value="<?php echo $_GET['tour_name']; ?>" readonly>

    <label for="">Họ và tên:</label>
    <input type="text" style="height: 40px;" id="hvt" name="HoVaTen" value="<?php echo htmlspecialchars($hoVaTen); ?>">

    <label for="">Số điện thoại:</label>
    <input type="text" style="height: 40px;" id="sdt" name="SDT" value="<?php echo htmlspecialchars($soDienThoai); ?>">

    <label for="">Email:</label>
    <input type="email" style="height: 40px;" id="email" name="Email" value="<?php echo htmlspecialchars($email); ?>">
</div>

<!-- Cột 2 -->
<div>
    <label for="">Địa chỉ:</label>
    <input type="text" style="height: 40px; margin-bottom: 10px;" id="add" name="DiaChi" value="<?php echo htmlspecialchars($diaChi); ?>">

    <label for="">Chọn số người:</label>
    <select name="so_luong" id="so_nguoi">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
    </select>

    <label for="">Giá/người:</label>
    <input type="text" id="Price" name="gia_nguoi" value="<?php echo $formattedPrice; ?>" readonly>

    <input type="button" id="tinhtien" value="Bấm vào đây để xem chi phí" style="width: fit-content; align-items: center;" onclick="TinhTien();">

    <label for="">Tổng thành tiền:</label>
    <input id="Thanhtoan" type="text" name="money" style="width: 100%; margin-bottom: 10px;">

    <input type="hidden" name="thoi_gian_dat" value="<?php echo date('Y-m-d H:i:s'); ?>">

    <button type="button" id="dattour" onclick="datTour()" style="width: 100%;">Đặt Tour</button>
</div>

<p>Sau khi bạn để lại thông tin và đặt tour DuLich3Mien.vn sẽ liên hệ với bạn sau 1-2 tiếng. Xin cảm ơn!</p>

    </form>


    <script>
        function TinhTien() {
    var soLuong = parseInt(document.getElementById("so_nguoi").value);  // Lấy số lượng người
    var price = parseInt(document.getElementById('Price').value.replace(/\s/g, ''));  // Lấy giá, loại bỏ khoảng trắng
    var money = price * soLuong;

    var formattedMoney = money.toLocaleString('vi-VN'); 
    // Hiển thị số tiền vào ô input với đơn vị "đồng"
    document.getElementById("Thanhtoan").value = formattedMoney + " đồng";
}


        function datTour() {
            var hvt = document.getElementById('hvt').value;
            var sdt = document.getElementById('sdt').value;
            var add = document.getElementById('add').value;
            var money = document.getElementById('Thanhtoan').value;

            // Kiểm tra các trường thông tin
            if (hvt == '' || sdt == '' || add == '' || money == '') {
                alert("Vui lòng điền đầy đủ thông tin");
            } else {
                alert("Đơn đặt Tour của bạn đã được gửi đi. Vui lòng chờ DuLich3Mien liên hệ!");

                // Gửi form sau khi thông tin hợp lệ
                document.forms[0].submit(); // Gửi form
            }
        }
    </script>


</body>

</html>
