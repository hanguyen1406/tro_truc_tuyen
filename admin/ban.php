<?php
    $jsonData = json_decode(file_get_contents('php://input'), true);
    $jsonFilePathUser = '../account.json';
    $jsonUserContents = file_get_contents($jsonFilePathUser);
    $jsonUserData = json_decode($jsonUserContents, true);
    
    if($jsonData['action'] == 'huy') {
        $jsonUserData[$jsonData['index']]['ban'] = -1;
        echo "Đã hủy truy cập";
    }else {
        $jsonUserData[$jsonData['index']]['ban'] = 0;
        echo "Đã cho phép truy cập";
    }

    $updatedData = json_encode($jsonUserData, JSON_PRETTY_PRINT);
    file_put_contents($jsonFilePathUser, $updatedData);
    



?>