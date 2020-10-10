<?php

try{
    $db =  new PDO("mysql:host=localhost;dbname=tes","root","",[PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION]);
} catch (Exception $error){
    // echo $error->getMessage();
}

$siswa=$db->query("select * from siswa"); // prepare statmen

$data_siswa=$siswa->fetchAll(); // Execute and get as array
// var_dump($data_siswa);

?>