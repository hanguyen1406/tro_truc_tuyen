<?php

$userid = intval($_COOKIE['id']);
$idtro = intval($_COOKIE['idtro']);

$jsonFilePathTro = './tro.json';
$jsonContents = file_get_contents($jsonFilePathTro);
$jsonData = json_decode($jsonContents, true);

$jsonFilePathUser = './account.json';
$jsonUserContents = file_get_contents($jsonFilePathUser);
$jsonUserData = json_decode($jsonUserContents, true);

$jsonData[$idtro]['status'] = 1;
$jsonUserData[$userid]['idtro'] = -1;
setcookie('idtro', -1 , time() + 3600, '/');

$updatedData = json_encode($jsonUserData, JSON_PRETTY_PRINT);
file_put_contents($jsonFilePathUser, $updatedData);

$updatedData = json_encode($jsonData, JSON_PRETTY_PRINT);
file_put_contents($jsonFilePathTro, $updatedData);

echo "Hủy trọ thành công";

?>
