<?php 

include 'function.php';
include 'connection.php';

if(isset($_GET['delete'])){
    deleteSiswa($_GET);
    header('Location:team.php');
}

if(isset($_POST['simpan'])){
    inputData($_POST);
    header('Location:team.php');
}

if(isset($_POST['search']))
{
    $filter=$db->quote($_POST['search']);
    

    $name=$_POST['search'];

    $search=$db->prepare("select * from tim where id_tim=? or id_siswa=? or sekolah=? or motivasi=?");

    $search->bindValue(1,$name,PDO::PARAM_STR);
    $search->bindValue(2,$name,pdo::PARAM_STR);
    $search->bindValue(3,$name,pdo::PARAM_STR);
    $search->bindValue(4,$name,pdo::PARAM_STR);

    $search->execute();

    $tampil_data=$search->fetchAll(); 

    $row = $search->rowCount();
    

}else{
    $data = $db->query("select * from tim");

    $tampil_data = $data->fetchAll();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col">
                <div class="d-flex mx-auto">
                        <h1 class="d-flex mx-auto">Data Siswa Magang</h1>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">ID Team</th>
                            <th scope="col">ID Siswa</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_siswa as $key):?>
                                <tr action="team.php" method="POST">
                                    <td><?php echo $key["id_tim"]; ?></td>
                                    <td><?php echo $key["id_siswa"]; ?></td>
                                    <td><?php echo $key["nama_siswa"]; ?></td>
                                <td><a class="btn btn-light" href="team.php?delete=&id_tim=<?php echo $key['id_tim']?>">Delete</a> | <a class="btn btn-light" href="edit.php?id_tim=<?php echo $key['id_tim']; ?>">Edit</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container">
        <div class="row">
                <div class="col-6">
                <h2>Tambah Data Siswa</h2>

            <form action="team.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ID Siswa</label>
                        <input type="text" name="id_tim" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Team</label>
                        <input type="text" name="nama_siswa" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary" name="simpan">simpan</button>
                    
                </form>
            </div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>