<?php
// Thông tin kết nối
$servername = "localhost"; 
$username = "root"; 
$dbname = "travel1";         
$password = "";       
      

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
// echo "Kết nối thành công!";
?>
