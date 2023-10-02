<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $index = $data->index; 
    $jsonFilePathTro = '../tro.json';
    $jsonContents = file_get_contents($jsonFilePathTro);
    $jsonData = json_decode($jsonContents, true);
    $not = count($jsonData);
    for ($i=0; $i < $not; $i++) { 
        if($jsonData[$i]['id'] == $index) {
            $jsonData[$i]['censor'] = 1;
            $updatedData = json_encode($jsonData, JSON_PRETTY_PRINT);
            file_put_contents($jsonFilePathTro, $updatedData);
            echo "1";
            exit();
        }
    }

}

?>