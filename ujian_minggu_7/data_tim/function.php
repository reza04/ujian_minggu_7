<?php 

function inputDataTeam($input=[])
{
    include 'connection.php';
    $sql='INSERT INTO  tim(id_siswa,nama_siswa) VALUES(?,?)';

    $result=$db->prepare($sql);
    $result->bindValue(1, $input['id_siswa'], PDO::PARAM_STR);
    $result->bindValue(2, $input['nama_siswa'], PDO::PARAM_STR);
    $result->execute();
}

function deleteSiswa($delete) {
    include 'connection.php';

    $sql = 'DELETE FROM tim WHERE id_tim = ?';

        $result = $db->prepare($sql);
        $result->bindValue(1, $delete['id_tim'], PDO::PARAM_INT);
        $result->execute();
}

function inputData($input=[])
{
    include 'connection.php';
    $sql='INSERT INTO  tim(id_tim,id_siswa,nama_siswa) VALUES(?,?,?)';

    $result=$db->prepare($sql);
    $result->bindValue(1, $input['id_tim'], PDO::PARAM_STR);
    $result->bindValue(3, $input['nama_siswa'], PDO::PARAM_STR);
    $result->execute();
}
?>