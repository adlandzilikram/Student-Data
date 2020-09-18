<?php
  error_reporting(0);
include 'koneksi.php';
  if(isset($_POST['simpan'])){
    $sql = mysqli_query($con, "INSERT INTO class VALUES ('','$_POST[class]')");

   if ($sql) {
      echo "<script>alert('Data berhasil masuk');
      document.location.href='?menu=class.php'</script>";
  }else{
      echo "<script>alert('Data gagal masuk');
      document.location.href='?menu=class.php'</script>";
    }
  }

  if(isset($_GET['edit'])) {
    $sql = mysqli_query($con, "SELECT * FROM class WHERE id = '$_GET[id]'");
    $isi = mysqli_fetch_array($sql);
  }
  if (isset($_POST['update'])) {
    $sql = mysqli_query($con, "UPDATE class SET class = '$_POST[class]' WHERE id = '$_GET[id]'");
    if ($sql) {
      echo "<script>alert('Data berhasil diubah');document.location.href='?menu=class.php';</script>";
    }else{
      echo "<script>alert('Data gagal diubah');document.location.href='?menu=class.php';</script>";
    }
  }

  if(isset($_GET['hapus'])){  
    $sql = mysqli_query($con, "DELETE FROM class WHERE id = '$_GET[id]'");
    if($sql){
      echo "<script>alert('Data berhasil dihapus');
      document.location.href='class.php'</script>";
    }else{
      echo "<script>alert('Data gagal dihapus');
      document.location.href='class.php'</script>";
    }
  }
 ?>


<!DOCTYPE html>
<head>
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="uhu.css">
</head>

<body>
  <div class="container banner col-md-12">
  <br><br><br><br>
    <div class="container">
       <div class="card">
           <div class="card-header">
             <div class="card-body">
                <div class="col-md-12">
                    <nav class="navbar navbar-navbar-md">
                      <div class="navbar-brand">
                      Input Data Kelas
                      </div>
                      <ul class="nav">
                        <li class="nav-item">
                          <a class="nav-link" href="tambah.php"> Data Siswa </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="index.php"> Keluar </a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                <div class="card-block">
                  <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                       <div class="form-group">             
                          <div class="row">
                              <div class="col">
                              <input type="text" name="class" class="form-control" placeholder="Nama class" required value="<?php echo $isi['class']?>">
                              </div>
                          </div><br>
                    
                      <?php if (isset($_GET['edit'])) {?>
                      <td><input class="btn btn-warning" type="submit" name="update" value="update"></td>
                      <?php }else{ ?>
                      <td><input class="btn btn-primary" type="submit" name="simpan" value="simpan"></td>
                      <?php } ?>

                      <hr>
                      <h4 class="card-title">Data Siswa</h4>
                       <div class="table-responsive">
                       <table class="table">
                        <thead>
                         <tr>
                          <th>No</th>
                          <th>Name class</th>
                          <th>aksi</th>
                        </tr>
                           <?php 
                           $no=0;
                           $sql = mysqli_query($con, "SELECT * FROM class");
                           while ($r=mysqli_fetch_array($sql)) {
                           $no++;
                           ?>
                         <tr>
                          <td><?= $no; ?></td>
                          <td><?= $r['class']; ?></td> 
                          <td><a class="btn btn-success" href="?menu=class.php&edit&id=<?php echo $r['id'] ?>">Edit</a></td>
                          <td><a class="btn btn-danger" href="?hapus&id=<?= $r['id'] ?>" onclick="return confirm('Anda yakin')">Hapus</a></td>
                         </tr>
                        </tbody>
                         <?php } ?>
                        </thead>
                       </table>
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
           </div>
       </div>
</body>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>     

