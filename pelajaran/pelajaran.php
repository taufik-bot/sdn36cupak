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

if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
} else {
  $msg = "";
}

$alert = '';
if ($msg == 'cancel'){
  $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <i class="fa-solid fa-circle-xmark"></i> Tambah pelajaran gagal, Mata pelajaran sudah ada..
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if ($msg == 'added'){
  $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <i class="fa-solid fa-circle-check"></i> Tambah pelajaran berhasil..
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if ($msg == 'deleted'){
  $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <i class="fa-solid fa-circle-check"></i> Pelajaran berhasil dihapus..
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if ($msg == 'cancelupdate'){
  $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <i class="fa-solid fa-circle-xmark"></i> Update pelajaran gagal, Mata pelajaran sudah ada..
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if ($msg == 'updated'){
  $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <i class="fa-solid fa-circle-check"></i> Pelajaran berhasil diperbaharui..
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"> Mata Pelajaran</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="../index.php"> Home</a></li>
                            <li class="breadcrumb-item active">Mata Pelajaran</li>
                        </ol>
                        <?php
                        if ($msg != '') {
                          echo $alert;
                        }
                        ?>
                        <div class="row">
                            <div class="col-4">
                            <div class="card">
  <div class="card-header">
  <i class="fa-solid fa-plus"></i> Tambah Pelajaran
  </div>
  <div class="card-body">
    <form action="proses-pelajaran.php" method="POST">
    <div class="mb-3">
    <label for="pelajaran" class="form-label ps-1">Pelajaran</label>
    <input type="text" class="form-control" id="pelajaran" name="pelajaran" placeholder="nama pelajaran" required>
  </div>
  <div class="mb-3">
    <label for="jurusan" class="form-label ps-1">Jurusan</label>
    <select name="jurusan" id="jurusan" class="form-select" required>
      <option value="" selected>--Pilih Jurusan--</option>
      <option value="umum" >Umum</option>
      <option value="khusus" >Khusus</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="guru" class="form-label ps-1">Guru</label>
    <select name="guru" id="guru" class="form-select" required>
        <option value="">--Pilih Guru--</option>
        <?php
        $queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru");
        while ($dataGuru = mysqli_fetch_array($queryGuru)) { ?>
            <option value="<?= $dataGuru['nama'] ?>"><?= $dataGuru['nama'] ?></option>
            <?php
        }
        ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary" name="simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
    <button type="reset" class="btn btn-danger" name="reset"><i class="fa-solid fa-xmark"></i> Reset</button>
    </form>
  </div>
</div>
                            </div>
                            <div class="col-8">
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
      <th scope="col"><center>Operasi</center></th>
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
      <td align="center">
        <a href="edit-pelajaran.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-warning" title="update pelajaran"><i class="fa-solid fa-pen"></i></a>
        <button type="button" data-id="<?= $data['id'] ?>" id="btnHapus" class="btn btn-sm btn-danger" title="hapus pelajaran"><i class="fa-solid fa-trash"></i></button>
      </td>
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
<!-- modal hapus data -->
<div class="modal" id="mdlHapus" tabindex="-1" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Anda yakin akan menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="" id="btnMdlHapus" class="btn btn-primary">Ya</a>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $(document).on('click', "#btnHapus", function(){
      $('#mdlHapus').modal('show');
      let id = $(this).data('id');
      $('#btnMdlHapus').attr('href', "hapus-pelajaran.php?id=" + id);
    })
  })
</script>

<?php

require_once "../template/footer.php";

?>