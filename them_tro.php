<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filePath = './tro.json';
    $existingData = file_get_contents($filePath);
    $dataArray = json_decode($existingData, true);
    $noa = count($dataArray);
    //tao json object cho tro
    
    
    // Convert the array to a JSON string
    $newData = json_decode(file_get_contents('php://input'), true);
    // id, time, user id
    $newData['userid'] = intval($_COOKIE['id']);
    $newData['time'] = date("d-m-Y H:i:s");
    $newData['id'] = $noa;
    $dataArray[] = $newData;
    $updatedData = json_encode($dataArray, JSON_PRETTY_PRINT);
    file_put_contents($filePath, $updatedData);

    echo "1";

}
?>
