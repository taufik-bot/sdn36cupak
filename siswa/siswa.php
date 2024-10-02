<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";
$title = "Siswa - SDN 36 Cupak";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"> Siswa</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="../index.php"> Home</a></li>
                            <li class="breadcrumb-item active">Siswa</li>
                        </ol>
                        <div class="card">
  <div class="card-header">
    <span class="h5 my-2"><i class="fa-solid fa-list"></i> Data Siswa</span>
    <a href="<?= $main_url ?>siswa/add-siswa.php" class= "btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> Tambah Siswa</a>
  </div>
  <div class="card-body">
  <table class="table table-hover" id="datatablesSimple">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col"><center>Foto</center></th>
      <th scope="col"><center>NIS</center></th>
      <th scope="col"><center>Nama</center></th>
      <th scope="col"><center>Kelas</center></th>
      <th scope="col"><center>Jurusan</center></th>
      <th scope="col"><center>Alamat</center></th>
      <th scope="col"><center>Operasi</center></th>
    </tr>
  </thead>
  <tbody>
 <?php
 $no = 1;
 $querySiswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa");
 while ($data = mysqli_fetch_array($querySiswa)){ ?>

 
 
    
    <tr>
      <th scope="row"><?=$no++ ?></th>
      <td align="center" ><img src="../asset/image/<?=$data['foto']?>" class="rounded-circle" alt="foto siswa" width="60px"></td>
      <td><?=$data['nis']?></td>
      <td><?=$data['nama']?></td>
      <td><?=$data['kelas']?></td>
      <td><?=$data['jurusan']?></td>
      <td><?=$data['alamat']?></td>
      <td align="center">
        <a href="edit-siswa.php?nis=<?= $data['nis'] ?>" class="btn brn-sm btn-warning" $title="Update Siswa"><i class="fa-solid fa-pen"></i></a>
        <a href="hapus-siswa.php?nis=<?=$data['nis'] ?> &foto=<?= $data['foto']?>" class="btn brn-sm btn-danger" $title="Hapus Siswa"><i class="fa-solid fa-trash" onclick="return confirm('Anda yakin akan menghapus data ini?') "></i></a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
  </div>
</div>
</div>
</main>



<?php

require_once "../template/footer.php";

?>