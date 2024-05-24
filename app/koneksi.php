<?php

$databaseHost = 'localhost';
$databaseName = 'poliklinik';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, 
    $databasePassword, $databaseName);
if (!$mysqli){
    die ("Koneksi Gagal:".mysqli_connect_error());
}
else{
    echo"Koneksi Berhasil";
}
?>