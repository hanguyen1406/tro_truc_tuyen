<?php


if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    $userid = $_COOKIE['id'];
    if (isset($_GET['index'])) {
        $index = $_GET['index'];
    }
    // Specify the path to your JSON file
    $jsonFilePathTro = './tro.json';
    $jsonFilePathUser = './account.json';
    
    $jsonContents = file_get_contents($jsonFilePathTro);
    $data = json_decode($jsonContents, true);

  
    $jsonUserContents = file_get_contents($jsonFilePathUser);
    $jsonUserData = json_decode($jsonUserContents, true);
    
    
} else {
    header("Location: http://trotot.infinityfreeapp.com/sign_in");
    // header("Location: http://trotot.infinityfreeapp.com/sign_in");
    exit(); // Make sure to exit after the redirect
} 
?>
