<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filePath = './tro.json';
    $existingData = file_get_contents($filePath);
    $dataArray = json_decode($existingData, true);
    //tao json object cho tro
    
    
    // Convert the array to a JSON string
    $newData = json_decode(file_get_contents('php://input'), true);
    $index = intval($newData['index']);
    $tro = json_decode('{}', true);

    $tro['userid'] = intval($_COOKIE['id']);
    $tro['time'] = date("d-m-Y H:i:s");
    $tro['id'] = $index;
    $tro['censor'] = $newData['tro']['censor'];
    $tro['title'] = $newData['tro']['title'];
    $tro['price'] = $newData['tro']['price'];
    $tro['status'] = $newData['tro']['status'];
    $tro['images'] = $newData['tro']['images'];
    $tro['province'] = $newData['tro']['province'];
    $tro['district'] = $newData['tro']['district'];
    $tro['address'] = $newData['tro']['address'];
    $tro['content'] = $newData['tro']['content'];
    $tro['area'] = $newData['tro']['area'];

    $dataArray[$index] = $tro;
    $updatedData = json_encode($dataArray, JSON_PRETTY_PRINT);
    file_put_contents($filePath, $updatedData);

    echo 'Đã yêu cầu chỉnh sửa';

}
?>
