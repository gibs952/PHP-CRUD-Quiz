<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "kepegawaian";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if(!$koneksi){
    die("404 Error not connected!");
}

// definisi variabel
$ni = "";
$nama = "";
$usia = "";
$gaji = "";
$sukses = "";
$error = "";


// tambah data
if(isset($_POST['simpan'])){
    $ni =$_POST['ni'];
    $nama =$_POST['nama'];
    $usia =$_POST['usia'];
    $gaji =$_POST['gaji'];
    if($ni && $nama && $usia && $gaji){
        $sql1 = "insert into info_pegawai(ID_pegawai,nama,usia,gaji) values ('$ni','$nama', '$usia', '$gaji')";
        $q1 = mysqli_query($koneksi, $sql1);
        if($q1){
            $sukses = "Input Data Baru Berhasil !";
        }else {
            $error = "Gagal Input Data Baru";
        }
    }else{
        $error = "Semua Form Wajib diisi!";
    }
}

// untuk edit data(update)
if(isset($_GET['op'])){
    $op = $_GET['op'];
}else{
    $op = "";

}

if($op == 'edit'){
    $id= $_GET['id'];
    $sql1 = "select * from info_pegawai where id = $id";
    $q1 = mysqli_query($koneksi,$sql1);
    $r1 = mysqli_fetch_array($q1);
    $ni = $r1['ni'];
    $nama = $r1['nama'];
    $usia = $r1['usia'];
    $gaji = $r1['gaji'];
}


// untuk hapus
// if(isset($_GET['op'])){
//     $op = $_GET['op'];
// }else{
//     $op = "";

// }

// // if($op == 'delete'){
//     $id= $_GET['id'];
//     $sql1 = "delete from info_pegawai where id = $id";
//     $q1 = mysqli_query($koneksi,$sql1);
//     $r1 = mysqli_fetch_array($q1);
//     $ni = $r1['ni'];
//     $nama = $r1['nama'];
//     $usia = $r1['usia'];
//     $gaji = $r1['gaji'];
// }
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kepegawaian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <style>
      .mx-auto {
        width: 800px;
      }
      .card {
        margin: top 10px;
      }
    </style>
  </head>
  <body>
    <div class="mx-auto">
      <div class="card">
        <div class="card-header">Buat/ Edit Data</div>
        <div class="card-body">
            <?php 
            if($error){
                ?>
                <div class="alert alert-danger" role="alert">
  <?php echo $error?>
</div>
<?php 
            }
            ?>
            
            <?php
            if($sukses){
                ?>
                <div class="alert alert-success" role="alert">
  <?php echo $sukses?>
</div>
<?php
            }
            ?>
            
          <form action="" method="POST">
          <div class="mb-3 row">
              <label for="ni" class="col-sm-2 col-form-label">ID Pegawai</label>
              <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" id="ni" name="ni" value="<?php echo $ni ?>" />
              </div>
            <div class="mb-3 row">
              <label for="nama" class="col-sm-2 col-form-label">Nama Pegawai</label>
              <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" id="nama" name="nama" value="<?php echo $nama ?>" />
              </div>
            </div>
            <div class="mb-3 row">
              <label for="nama" class="col-sm-2 col-form-label">Usia</label>
              <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" id="usia" name="usia" value="<?php echo $usia ?>" />
              </div>
            </div>
            <div class="mb-3 row">
              <label for="nama" class="col-sm-2 col-form-label">Gaji</label>
              <div class="col-sm-10">
                <input type="text"  class="form-control-plaintext" id="gaji" name="gaji" value="<?php echo $gaji ?>" />
              </div>
            </div>
            <div class="col-12">
              <input type="submit" name="simpan" value="simpan" class="btn btn-primary" />
            </div>
          </form>
        </div>
      </div>
      <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID Pegawai</th>
            <th scope="col">Nama Pegawai</th>
            <th scope="col">Usia</th>
            <th scope="col">Gaji</th>
          </tr>
          <tbody>
            <?php
            $sql2 = "select * from info_pegawai order by id desc";
            $q2 = mysqli_query($koneksi,$sql2);
            $urut = 1;
            while($r2 = mysqli_fetch_array($q2)){
                $id = $r2['id'];
                $nama = $r2['nama'];
                $usia = $r2['usia'];
                $gaji = $r2['gaji'];
                ?>
            <tr>
                <th scope="row"><?php echo $urut++ ?> </th>
                <td scope="row"><?php echo $ni ?></td>
                <td scope="row"><?php echo $nama ?></td>
                <td scope="row"><?php echo $usia ?></td>
                <td scope="row"><?php echo $gaji ?></td>
                <td scope="row">
                <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                <a href="index.php?op=delete&id=<?php echo $id ?>"><button type="button" class="btn btn-danger">Hapus</button></a>
        </td>
        </tr>
        <?php
            }?>

          </tbody>
        </thead>
      </table>
    </div>
    </div>
  </body>
</html>
