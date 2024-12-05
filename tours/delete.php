<?php
include 'D:\xampp\htdocs\project_ttcsn\includes\connect.php'; // Kết nối đến database


if (isset($_GET["id"])) {
    $tour_id = $_GET["id"];
    $sql = "DELETE FROM tours WHERE tour_id = $tour_id";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: http://localhost/project_ttcsn/admin/dashboard.php?page=tours");
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    echo "Không có TourID để xóa.";
}

$conn->close();
?>
