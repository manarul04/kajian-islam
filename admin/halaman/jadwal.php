<?php // jika submit button diklik
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if ($_POST['submit'] == "Simpan") {
    $namaFile = "JADWAL" . "-" . $_POST["nama_kajian"] . ".jpg";
    $dirUpload = "img/jadwal/";
    $data = array(
      "nama_kajian" => $_POST['nama_kajian'],
      "nama_ustad"  => $_POST['nama_ustad'],
      "tanggal"     => $_POST['tanggal'],
      "lokasi"      => $_POST['lokasi'],
      "foto"        => $namaFile
    );
    Insert("tb_jadwal", $data);

    $file_name = $_FILES['foto']['tmp_name'];
    $folder = $dirUpload . $namaFile;
    copy($file_name, $folder);
    // echo("<meta http-equiv='refresh' content='1'>"); //Refresh by HTTP 'meta'

  } else if ($_POST['submit'] == "Edit") {
    if (isset_file('foto')) {
      // $format = ".".end((explode(".", $name = $_FILES["foto"]["name"]))); # extra () to prevent notice
      $namaFile = "JADWAL" . "-" . $_POST["nama_kajian"] . ".jpg";
      $namaSementara = $_FILES['foto']['tmp_name'];
      $dirUpload = "img/jadwal/";
      // pindahkan file
      $file_name = $_FILES['foto']['tmp_name'];
      $folder = $dirUpload . $namaFile;
      copy($file_name, $folder);
    } else {
      $namaFile = $_POST["foto_lama"];
    }
    $data2 = array(
      "nama_kajian" => $_POST['nama_kajian'],
      "nama_ustad"  => $_POST['nama_ustad'],
      "tanggal"     => $_POST['tanggal'],
      "lokasi"      => $_POST['lokasi'],
      "foto"        => $namaFile
    );
    Update("tb_jadwal", $data2, "id_jadwal =" . $_POST['id_jadwal']);
  } else if ($_POST['submit'] == "Hapus") {
    $id_jadwal = $_POST['id_jadwal'];
    Delete("tb_jadwal", "WHERE id_jadwal = '" . $id_jadwal . "'");
    if (array_key_exists('delete_file', $_POST)) {
      $filename = "img/foto/" . $_POST['delete_file'];
      if (file_exists($filename)) {
        unlink($filename);
      } else {
        echo 'Could not delete ' . $filename . ', file does not exist';
      }
    }
    // echo '<meta http-equiv="refresh" content="0; url=index.php?halaman=ustad" />';//now refresh page

  }
}
?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Jadwal</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Jadwal</li>
    </ol>
  </div>
  <!-- Row -->
  <div class="row">
    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Data Jadwal</h6>
          <button class="btn btn-primary" type="button" class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#tambah">+ Tambah Jadwal</a>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Kajian</th>
                <th>Nama Ustad</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $data = mysqli_query($connect, "SELECT * from tb_jadwal ");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <tr>
                  <td><?php echo $no;
                      $no++; ?></td>
                  <td><a data-fancybox="foto" title="foto Jadwal" href="img/jadwal/<?= $d['foto']; ?>"><img src="img/jadwal/<?= $d['foto']; ?>" width="50" alt=""></a> </td>
                  <td><a href="" data-toggle="modal" data-target="#modald<?php echo $d['id_jadwal']; ?>"><?php echo $d['nama_kajian']; ?></a></td>
                  <td><?php echo $d['nama_ustad']; ?></td>
                  <td><?php echo $d['tanggal']; ?></td>
                  <td><?php echo $d['lokasi']; ?></td>
                  <td>
                    <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal<?php echo $d['id_jadwal']; ?>"><i class="fa fa-edit"></i> </a>
                    <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalh<?php echo $d['id_jadwal']; ?>"><i class="fa fa-trash"></i></a>

                    <!--Hapus-->
                    <div class="modal fade" id="modalh<?php echo $d['id_jadwal']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="card mb-4">
                              <div class="card-body">
                                <center>Yakin ingin menghapus data <h5>
                                    <div class="text-primary"><?= $d['nama_kajian'] ?></div>
                                  </h5>
                                </center>
                                <form method="POST">
                                  <input type="hidden" name="id_jadwal" value="<?php echo $d['id_jadwal']; ?>">
                                  <input type="hidden" value="<?php echo $d['foto']; ?>" name="delete_file">
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <!-- <a href="halaman/ustad.php?aksi=delete&id=<?php echo $d['id_jadwal']; ?>" class="btn btn-primary" >Hapus</a> -->
                            <input type="submit" class="btn btn-primary" name="submit" value="Hapus" />
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Hapus -->
                    <!-- Detail -->
                    <div class="modal fade" id="modald<?php echo $d['id_jadwal']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelLogout">Detail Data Jadwal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="card mb-4">
                              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Data Jadwal</h6>
                              </div>
                              <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                  <center>
                                    <a data-fancybox="foto" title="foto" href="img/foto/<?= $d['foto']; ?>"><img src="img/foto/<?= $d['foto']; ?>" width="150" alt=""></a>
                                  </center>
                                  <table class="table table-striped" style="margin-top:50px">
                                    <tbody style="padding-left:20px">
                                      <tr>
                                        <td scope="row">Nama Jadwal</td>
                                        <td><?= $d['nama_kajian']; ?></td>
                                      </tr>
                                      <tr>
                                        <td scope="row">Lokasi</td>
                                        <td><textarea class="form-control" id="editor1" onclick="auto_grow(this)" name="resume"><?= $d['lokasi'] ?></textarea></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Detail -->
                    <!-- Edit -->
                    <div class="modal fade" id="modal<?php echo $d['id_jadwal']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelLogout">Edit Data Jadwal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="card mb-4">
                              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Data Jadwal</h6>
                              </div>
                              <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Kajian</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="nama_kajian" placeholder="Nama Kajian" value="<?= $d['nama_kajian'] ?>" required>
                                      <input type="text" class="form-control" name="id_jadwal" value="<?= $d['id_jadwal'] ?>" required hidden>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Ustad</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="nama_ustad" value="<?= $d['nama_ustad'] ?>">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tanggal</label>
                                    <div class="col-sm-9">
                                      <input type="datetime-local" class="form-control" name="tanggal" value="<?= $d['tanggal'] ?>">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Lokasi</label>
                                    <div class="col-sm-9">
                                      <textarea class="form-control" id="editor1" name="lokasi" onclick="auto_grow(this)"><?= $d['lokasi'] ?></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">foto</label>
                                    <div class="col-sm-9">
                                      <input type="file" class="form-control" name="foto">
                                      <input type="text" class="form-control" name="foto_lama" value="<?= $d['foto']; ?>" hidden>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" name="submit" value="Edit" />
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- End Edit -->
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!--Row-->
  <!-- Tambah Jadwal -->
  <div class="modal fade bd-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelLogout">Tambah Jadwal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Data Jadwal</h6>
            </div>
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Jadwal</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama_kajian">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Ustad</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama_ustad">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tanggal</label>
                  <div class="col-sm-9">
                    <input type="datetime-local" class="form-control" name="tanggal">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Lokasi</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" id="editor1" name="lokasi"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Foto</label>
                  <div class="col-sm-9">
                    <input type="file" class="form-control" name="foto">
                  </div>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary" name="submit" value="Simpan" />
          </form>
        </div>
      </div>
    </div>
  </div>