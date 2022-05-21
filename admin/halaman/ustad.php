<?php // jika submit button diklik
            if($_SERVER['REQUEST_METHOD'] == "POST"){
              if($_POST['submit']=="Simpan"){
                $namaFile = "USTAD"."-".$_POST["nama_ustad"].".jpg";
                $dirUpload = "img/foto/";
                $data=array(
                  "nama_ustad"  => $_POST['nama_ustad'],
                  "deskripsi"  => $_POST['deskripsi'],
                  "foto" => $namaFile
                );
                Insert("tb_ustad",$data);
                
                $file_name = $_FILES['foto']['tmp_name'];
                $folder=$dirUpload.$namaFile;
                copy($file_name, $folder);
                // echo("<meta http-equiv='refresh' content='1'>"); //Refresh by HTTP 'meta'
                
              }else if($_POST['submit']=="Edit"){
                if(isset_file('foto')) {
                  // $format = ".".end((explode(".", $name = $_FILES["foto"]["name"]))); # extra () to prevent notice
                  $namaFile = "USTAD"."-".$_POST["nama_ustad"].".jpg";
                  $namaSementara = $_FILES['foto']['tmp_name'];
                  $dirUpload = "img/foto/";
                  // pindahkan file
                  $file_name = $_FILES['foto']['tmp_name'];
                    $folder=$dirUpload.$namaFile;
                    copy($file_name, $folder);
                }else{
                    $namaFile=$_POST["foto_lama"];
                }
                $data2=array(
                  "nama_ustad"  => $_POST['nama_ustad'],
                  "deskripsi"  => $_POST['deskripsi'],
                  "foto" => $namaFile
                );
                Update("tb_ustad",$data2,"id_ustad =".$_POST['id_ustad']);
              }else if($_POST['submit']=="Hapus"){
                $id_ustad = $_POST['id_ustad'];
                Delete("tb_ustad","WHERE id_ustad = '".$id_ustad."'");
                if (array_key_exists('delete_file', $_POST)) {
                  $filename = "img/foto/".$_POST['delete_file'];
                  if (file_exists($filename)) {
                    unlink($filename);
                  } else {
                    echo 'Could not delete '.$filename.', file does not exist';
                  }
                }
                // echo '<meta http-equiv="refresh" content="0; url=index.php?halaman=ustad" />';//now refresh page
                
              }
            }            
          ?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ustad</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Ustad</li>
            </ol>
          </div>
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Ustad</h6>
                  <button class="btn btn-primary" type="button" class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#tambah">+ Tambah Ustad</a>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Ustad</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $no = 1;
                      $data = mysqli_query($connect,"SELECT * from tb_ustad ");
                      while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                          <td><?php echo $no; $no++; ?></td>
                          <td><a data-fancybox="foto" title="foto Ustad" href="img/foto/<?=$d['foto'];?>"><img src="img/foto/<?=$d['foto'];?>" width="50" alt=""></a> </td>
                          <td><a href=""  data-toggle="modal" data-target="#modald<?php echo $d['id_ustad']; ?>"><?php echo $d['nama_ustad']; ?></a></td>
                          <td><?php echo $d['deskripsi']; ?></td>
                          <td>
                            <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal<?php echo $d['id_ustad']; ?>"><i class="fa fa-edit"></i> </a>
                            <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalh<?php echo $d['id_ustad']; ?>"><i class="fa fa-trash"></i></a>
                          
                            <!--Hapus-->
                            <div class="modal fade" id="modalh<?php echo $d['id_ustad']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <center>Yakin ingin menghapus data <h5><div class="text-primary"><?=$d['nama_ustad']?></div></h5></center>
                                        <form method="POST">
                                          <input type="hidden" name="id_ustad" value="<?php echo $d['id_ustad']; ?>">
                                          <input type="hidden" value="<?php echo $d['foto']; ?>" name="delete_file">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <!-- <a href="halaman/ustad.php?aksi=delete&id=<?php echo $d['id_ustad']; ?>" class="btn btn-primary" >Hapus</a> -->
                                    <input type="submit" class="btn btn-primary" name="submit" value="Hapus" />
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Hapus -->
                            <!-- Detail -->
                            <div class="modal fade" id="modald<?php echo $d['id_ustad']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Detail Data Ustad</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="card mb-4">
                                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Data Ustad</h6>
                                      </div>
                                      <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                          <center>
                                            <a data-fancybox="foto" title="foto" href="img/foto/<?=$d['foto'];?>"><img src="img/foto/<?=$d['foto'];?>" width="150" alt=""></a>
                                          </center>
                                          <table class="table table-striped" style="margin-top:50px">
                                            <tbody style="padding-left:20px">
                                              <tr>
                                                <td scope="row">Nama Ustad</td>
                                                <td><?=$d['nama_ustad'];?></td>
                                              </tr>
                                              <tr>
                                                <td scope="row">Deskripsi</td>
                                                <td><textarea class="form-control" id="editor1" onclick="auto_grow(this)" name="resume"><?=$d['deskripsi']?></textarea></td>
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
                            <div class="modal fade" id="modal<?php echo $d['id_ustad']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Edit Data Ustad</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                <div class="modal-body">
                                  <div class="card mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                      <h6 class="m-0 font-weight-bold text-primary">Data Ustad</h6>
                                    </div>
                                    <div class="card-body">
                                      <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Nama Ustad</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nama_ustad" placeholder="Nama Ustad" value="<?=$d['nama_ustad']?>" required>
                                            <input type="text" class="form-control" name="id_ustad" value="<?=$d['id_ustad']?>" required hidden>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Deskripsi</label>
                                          <div class="col-sm-9">
                                            <textarea class="form-control" id="editor1" name="deskripsi" onclick="auto_grow(this)"><?=$d['deskripsi']?></textarea>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">foto</label>
                                          <div class="col-sm-9">
                                            <input type="file" class="form-control" name="foto">
                                            <input type="text" class="form-control" name="foto_lama" value="<?=$d['foto'];?>" hidden>
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
          <!-- Tambah Ustad -->
          <div class="modal fade bd-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Tambah Ustad</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <div class="modal-body">
                <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Ustad</h6>
                  </div>
                  <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Ustad</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="nama_ustad">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" id="editor1" name="deskripsi"></textarea>
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
        