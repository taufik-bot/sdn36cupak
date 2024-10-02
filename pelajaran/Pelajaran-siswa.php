<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";
$title = "Mata Pelajaran - SDN 36 Cupak";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";


?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"> Mata Pelajaran</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="../index.php"> Home</a></li>
                            <li class="breadcrumb-item active">Mata Pelajaran</li>
                        </ol>

                            <div>
                                <div class="card">
                             <div class="card-header">
                             <i class="fa-solid fa-list"></i> Data Pelajaran
                             </div>   
                             <div class="card-body">
                             <table class="table table-hover" id="datatablesSimple">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col"><center>Mata Pelajaran</center></th>
      <th scope="col"><Center>Guru</Center></th>
      <th scope="col"><Center>Jurusan</Center></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $queryPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran");
    while ($data = mysqli_fetch_array($queryPelajaran)) { ?>
    
    <tr>
      <th scope="row"><?= $no++ ?></th>
      <td><?= $data['pelajaran'] ?></td>
      <td><?= $data['guru'] ?></td>
      <td><?= $data['jurusan'] ?></td>
    </tr>
    <?php 
    } ?>
  </tbody>
</table>
                             </div>   
                             </div>
                            </div>
                        </div>
</div>
</main>

  </div>

<?php

require_once "../template/footer.php";

?>