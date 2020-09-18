<?php
  error_reporting(0);
include 'koneksi.php';
  if(isset($_POST['simpan'])){
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $class = $_POST['class'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $sql = "INSERT INTO `student` (`nim`, `nama`, `birthdate`, `gender`, `class`, `phone`, `address`) VALUES ('$nim', '$nama', '$birthdate', '$gender', '$class', '$phone', '$address')";
    $query = mysqli_query($con,$sql);

    if ($query) {
      echo "<script>alert('Data berhasil masuk');
      document.location.href='?menu=tambah.php'</script>";
   }else{
      echo "<script>alert('Data gagal masuk');
      document.location.href='?menu=tambah.php'</script>";
    }
  }

  if(isset($_GET['edit'])) {
    $sql = mysqli_query($con, "SELECT * FROM student WHERE id = '$_GET[id]'");
    $isi = mysqli_fetch_array($sql);
  }
   if (isset($_POST['update'])) {
    $sql = mysqli_query($con, "UPDATE student SET nim = '$_POST[nim]', nama = '$_POST[nama]', birthdate = '$_POST[birthdate]', gender = '$_POST[gender]', class = '$_POST[class]', phone = '$_POST[phone]', address = '$_POST[address]' WHERE id = '$_GET[id]'");
     if ($sql) {
      echo "<script>alert('Data berhasil diubah');document.location.href='?menu=tambah.php';</script>";
     }else{
      echo "<script>alert('Data gagal diubah');document.location.href='?menu=tambah.php';</script>";
    }
  }

  if(isset($_GET['hapus'])){  
    $sql = mysqli_query($con, "DELETE FROM student WHERE nim = '$_GET[id]'");
    if($sql){
      echo "<script>alert('Data berhasil dihapus');
      document.location.href='tambah.php'</script>";
    }else{
      echo "<script>alert('Data gagal dihapus');
      document.location.href='tambah.php'</script>";
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
  <br><br>
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
                          <a class="nav-link" href="class.php"> Data Kelas </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="index.php" class=""> Keluar </a>
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
                              <input type="text" name="nim" class="form-control" placeholder="Nim" required value="<?php echo $isi['nim']?>">
                              </div>
                                <div class="col">
                                <input type="text" name="nama" class="form-control" placeholder="Nama" required value="<?php echo $isi['nama']?>">
                              </div>

                          </div>
                          <br>
                          <div class="row">
                            <div class="col">
                            <input type="date" name="birthdate" class="form-control" placeholder="Birth Date" required value="<?php echo $isi['birthdate']?>">
                            </div>

                              <div class="col">
                              <select name="gender" value="<?php echo $isi['gender']?>">
                               <option value="" disabled-selected>-----Jenis Kelamin-----</option>
                               <option>L</option>
                               <option>P</option>
                              </select>

                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col">
                             <select name="class" class="form-control">
                             <?php 
                             $sql="SELECT * FROM class";
                             $query=mysqli_query($con, $sql);
                             while ($r=mysqli_fetch_assoc($query)) { ?>
                              <option value="<?= $r['id'] ?>"><?= $r['class']; ?></option>
                             <?php } ?>
                             </select>
                            </div>
                              <div class="col">
                               <input type="text" name="phone" class="form-control" placeholder="No HP" required value="<?php echo $isi['phone']?>">
                              </div>
                          </div><br>
                          <div class="row">
                            <div class="col">
                            <input type="text" name="address" class="form-control" placeholder="Address" required value="<?php echo $isi['address']?>">
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
                          <th>Nim</th>
                          <th>Nama</th>
                          <th>Birth Date</th>
                          <th>Gender</th>
                          <th>Class</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>aksi</th>

                        </tr>

                           <?php 
                           $no=0;
                           $sql = mysqli_query($con, "SELECT * FROM student");
                           while ($r=mysqli_fetch_array($sql)) {
                           $no++;
                           ?>

                         <tr>

                          <td><?= $no; ?></td>
                          <td><?= $r['nim']; ?></td>         
                          <td><?= $r['nama']; ?></td>
                          <td><?= $r['birthdate']; ?></td>
                          <td><?= $r['gender']; ?></td>         
                          <td><?= $r['class']; ?></td>
                          <td><?= $r['phone']; ?></td>
                          <td><?= $r['address']; ?></td>
                          <td><a class="btn btn-success" href="?menu=tambah.php&edit&id=<?php echo $r['id'] ?>">Edit</a></td>
                          <td><a href="?hapus&id=<?= $r['nim'] ?>" onclick="return confirm('Anda yakin')">Hapus</a></td>

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

