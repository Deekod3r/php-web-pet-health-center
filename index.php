<?php
$hostname = "localhost";
$username = "root";
$password = "123456";
$databasename = "web_shop_pet";

$conn = new mysqli($hostname, $username, $password, $databasename);
if($conn->connect_error) {
    die("Lỗi khi kết nối MySQL");
} else echo "hahah";

function a(){
    echo "hi Dung";
}

a();
A();
// return $conn;