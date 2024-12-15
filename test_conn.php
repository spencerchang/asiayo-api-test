<?php
// 保存到 /var/www/html/test_conn.php
$conn = mysqli_connect("mysql", "root", "root", "asiayo");

if ($conn) {
    echo "Connected successfully";
    mysqli_close($conn);
} else {
    echo "Connection failed: " . mysqli_connect_error();
}
