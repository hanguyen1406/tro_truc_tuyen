<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filePath = '../account.json';
    $existingData = file_get_contents($filePath);

    $dataArray = json_decode($existingData, true);

    $newData = json_decode(file_get_contents('php://input'), true);
    $noa = count($dataArray);

    for ($i=0; $i < $noa; $i++) { 
        if($dataArray[$i]['email'] == $newData['email']) {
            echo "0";
            exit();
        }
    }

    $newData['id'] = $noa;
    $dataArray[] = $newData;

    $updatedData = json_encode($dataArray, JSON_PRETTY_PRINT);

    file_put_contents($filePath, $updatedData);

    echo '1';
}
?>
