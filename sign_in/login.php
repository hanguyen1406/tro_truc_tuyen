<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $jsonData = json_decode(file_get_contents('php://input'), true);

    $filePath = '../account.json';
    $existingData = file_get_contents($filePath);
    $dataArray = json_decode($existingData, true);
    
    if($jsonData['email'] == 'admin' && $jsonData['password'] == 12345) {
        echo '-1';
        setcookie('admin', 'admin', time() + 3600, '/');
        exit();
    }
    if($dataArray !== null) {
        // echo json_encode($dataArray[0]['email'], JSON_PRETTY_PRINT);
        //0:chua dang ky, 1:sai mat khau, 2:dang nhap thanh cong, -1:bi cam
        $lengAcc = count($dataArray);
        for($i = 0; $i < $lengAcc; $i++) {
            if($dataArray[$i]['email'] == $jsonData['email']) {
                if($dataArray[$i]['password'] == $jsonData['password']) {
                    if($dataArray[$i]['ban'] == -1) {
                        echo '3';
                        exit();
                    }
                    echo '2';
                    $username = $dataArray[$i]['username'];
                    $sex = $dataArray[$i]['sex'];
                    $id = $dataArray[$i]['id'];
                    $role = $dataArray[$i]['role'];
                    $idtro = $dataArray[$i]['idtro'];
                    setcookie('username', $username, time() + 3600, '/');
                    setcookie('avatar', $sex . ".png", time() + 3600, '/');
                    setcookie('id', $id , time() + 3600, '/');
                    setcookie('role', $role , time() + 3600, '/');
                    setcookie('idtro', $idtro, time() + 3600, '/');

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
