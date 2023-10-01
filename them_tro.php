<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $price = $_POST["price"];
    $images = $_POST["images"];
    $area = $_POST["area"];
    $province = $_POST["province"];
    $district = $_POST["district"];
    $address = $_POST["address"];
    $content = $_POST["content"];

    echo $images;
    
}
?>
