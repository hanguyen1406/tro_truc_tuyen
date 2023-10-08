<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the JSON data sent from JavaScript
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    // Extract the 'index' property
    $index = $data->index;

    $userid = $_COOKIE['id'];
    //tra ve 0 la khong dat duoc tro vi da co phong dang dat roi
    //tra ve 1 la dat tro thanh cong
    $jsonFilePathTro = './tro.json';
    $jsonContents = file_get_contents($jsonFilePathTro);
    $jsonData = json_decode($jsonContents, true);

    $jsonFilePathUser = './account.json';
    $jsonUserContents = file_get_contents($jsonFilePathUser);
    $jsonUserData = json_decode($jsonUserContents, true);
    

    $not = count($jsonData);
    for ($i=0; $i < $not; $i++) { 
        if($jsonData[$i]['id'] == $index && $jsonUserData[$userid]['idtro'] == -1) {
            if(intval($jsonData[$i]['role']) == 2) {
                echo '2';
                exit();
            }
            $jsonData[$i]['status'] = 0;
            $updatedData = json_encode($jsonData, JSON_PRETTY_PRINT);
            file_put_contents($jsonFilePathTro, $updatedData);

            $jsonUserData[$userid]['idtro'] = $index;
            setcookie('idtro', $index, time() + 3600, '/');
            $updatedData = json_encode($jsonUserData, JSON_PRETTY_PRINT);
            file_put_contents($jsonFilePathUser, $updatedData);
            echo "1";
            exit();
        }
    }
    echo "0";
}
?>
