<?php 

// insert into siswa (nama_siswa,sekolah,motivasi) values('".$_POST['nama_siswa']."','".$_POST['sekolah']."','".$_POST['motivasi']."')"
function inputData($input=[])
{
    include 'connection.php';
    $sql='INSERT INTO  siswa(nama_siswa,sekolah,motivasi) VALUES(?,?,?)';

    $result=$db->prepare($sql);
    $result->bindValue(1, $input['nama_siswa'], PDO::PARAM_STR);
    $result->bindValue(2, $input['sekolah'], PDO::PARAM_STR);
    $result->bindValue(3, $input['motivasi'], PDO::PARAM_STR);
    $result->execute();
}

function deleteSiswa($delete) {
    include 'connection.php';

    $sql = 'DELETE FROM siswa WHERE id_siswa = ?';

    try {
        $result = $db->prepare($sql);
        $result->bindValue(1, $delete['id_siswa'], PDO::PARAM_INT);
        $result->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return true;
}

function edit($edit=[]) {
    include 'connection.php';

    $sql = 'UPDATE siswa SET nama_siswa = ?, sekolah = ?, motivasi = ? WHERE id_siswa = ?';

    $result=$db->prepare($sql);
    $result->bindValue(1, $edit['id_siswa'.'sekolah'.'motivasi'], PDO::PARAM_STR);
}

function inputDataTeam($input=[])
{
    include 'connection.php';
    $sql='INSERT INTO  tim(id_siswa,nama_siswa) VALUES(?,?)';

    $result=$db->prepare($sql);
    $result->bindValue(1, $input['id_siswa'], PDO::PARAM_STR);
    $result->bindValue(2, $input['nama_siswa'], PDO::PARAM_STR);
    $result->execute();
}