<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $jsonData = json_decode(file_get_contents('php://input'), true);

    $filePath = '../account.json';

    // Read the existing JSON data from the file
    $existingData = file_get_contents($filePath);
    // Decode the JSON data into a PHP array
    $dataArray = json_decode($existingData, true);
    
    if($dataArray !== null) {
        // echo json_encode($dataArray[0]['email'], JSON_PRETTY_PRINT);
        //0:chua dang ky, 1:sai mat khau, 2:dang nhap thanh cong
        $lengAcc = count($dataArray);
        for($i = 0; $i < $lengAcc; $i++) {
            if($dataArray[$i]['email'] == $jsonData['email']) {
                if($dataArray[$i]['password'] == $jsonData['password']) {
                    echo '2';
                    $username = $dataArray[$i]['username'];
                    $sex = $dataArray[$i]['sex'];
                    setcookie('username', $username, time() + 3600, '/');
                    setcookie('avatar', $sex . ".png", time() + 3600, '/');

                }else {
                    echo '1';
                }
            }
        }
    }else {

        echo '0';
    }
    
}
?>