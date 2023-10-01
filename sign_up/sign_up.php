<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Define the path and filename of the JSON file
    $filePath = '../account.json';

    // Read the existing JSON data from the file
    $existingData = file_get_contents($filePath);

    // Decode the JSON data into a PHP array
    $dataArray = json_decode($existingData, true);

    // Get the new JSON data from the POST request
    $newData = json_decode(file_get_contents('php://input'), true);
    $noa = count($dataArray);

    for ($i=0; $i < $noa; $i++) { 
        if($dataArray[$i]['email'] == $newData['email']) {
            echo "0";
            exit();
        }
    }

    $newData['id'] = $noa;
    // Append the new data to the array
    $dataArray[] = $newData;

    // Encode the updated array as JSON
    $updatedData = json_encode($dataArray, JSON_PRETTY_PRINT);

    // Save the updated JSON data back to the file
    file_put_contents($filePath, $updatedData);

    // Optionally, you can send a response back to the client
    echo '1';
}
?>
