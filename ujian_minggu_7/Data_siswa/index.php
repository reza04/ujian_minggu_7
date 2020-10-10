<?php

/**
 * Penilaian Ujian Minggu Ke 7
 * 
 * 1 poin user interfacemenggunakan bootstrap
 * 1 poin aplikasi dapat menampikan data siswa dan tim dari database ke sebuah user interface
 * 1 poin aplikasi dapat menyimpan data siswa dan tim dari database
 * 1 poin aplikasi dapat memperbarui data siswa dan tim dari database
 * 1 poin aplikasi dapat menghapus data siswa dari dalam database
 * 1 poin aplikasi memiliki fitur untuk filter data siswa berdasarkan sekolah dan nama tim
 * 1 poin aplikasi memiliki fitur untuk mencari data siswa maupun data tim
 * 2 poin terdapat notifikasi banyaknya data yang di cari
 * 1 poin terdapat pop up modal dari bootstrap untuk notifikasi saat user ingin menghapus data
 */

include "function.php";
include "connection.php";

if(isset($_GET['delete'])){
    // var_dump($_GET);
    // exit;
    deleteSiswa($_GET);
    header('Location:index.php');
}

if(isset($_POST['simpan'])){
    inputData($_POST);
    header('Location: index.php');
}


if(isset($_POST['search']))
{
    $filter=$db->quote($_POST['search']);
    

    $name=$_POST['search'];

    $search=$db->prepare("select * from siswa where id_siswa=? or nama_siswa=? or sekolah=? or motivasi=?");

    $search->bindValue(1,$name,PDO::PARAM_STR);
    $search->bindValue(2,$name,pdo::PARAM_STR);
    $search->bindValue(3,$name,pdo::PARAM_STR);
    $search->bindValue(4,$name,pdo::PARAM_STR);

    $search->execute();

    $tampil_data=$search->fetchAll(); 

    $row = $search->rowCount();
    

}else{
    $data = $db->query("select * from siswa");

    $tampil_data = $data->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Data</title>
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
                        <th scope="col">ID Siswa</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Sekolah</th>
                        <th scope="col">Motivai</th>
                        <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_siswa as $key):?>
                            <tr action="index.php" method="POST">
                            <td><?php echo $key["id_siswa"]; ?></td>
                                <td><?php echo $key["nama_siswa"]; ?></td>
                                <td><?php echo $key["sekolah"]; ?></td>
                                <td><?php echo $key["motivasi"]; ?></td>
                                <td><a class="btn btn-light" data-toggle="modal" data-target="#siswa">Hapus</a> | <a class="btn btn-light" href="edit.php?id_siswa=<?php echo $key['id_siswa']; ?>">Edit</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" id="siswa" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus data ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><a style="color:white" href="index.php?delete=&id_siswa=<?php echo $key['id_siswa']; ?>">Hapus</a></button>
      </div>
    </div>
  </div>
</div>
    
    <div class="container">
        <div class="row">
                <div class="col-6">
                <h2>Tambah Data Siswa</h2>

            <form action="index.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Sekolahan</label>
                        <input type="text" name="sekolah" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Motivasi</label>
                        <input type="text" name="motivasi" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary" name="simpan">simpan</button>
                    
                </form>
            </div>

        <!-- mencari data siswa -->
    
        <div class="col-6">
            <h2>Cari Siswa</h2>

            <!-- Allert Massage -->
            <?php if(isset($row)):?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <p class="lead "><?php echo $row;?> Data Ditemukan !</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>
            <form class="form-inline" action="index.php" method="POST">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" name="search" placeholder="nama atau sekolah">
                    <input type="submit" value="Cari">
                </div>
            </form>
            <a href="..\data_tim\team.php">Menu Data Team</a>
            </div>


<hr>
<hr>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>