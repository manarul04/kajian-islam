<?php // jika submit button diklik
            if($_SERVER['REQUEST_METHOD'] == "POST"){
              if($_POST['submit']=="Simpan"){
                $namaFile = $_POST["tanggal"]."-".$_POST["judul"].".jpg";
                $dirUpload = "img/thumbnail/";
                $data=array(
                  "judul"  => $_POST['judul'],
                  "id_ustad" => $_POST['id_ustad'],
                  "id_kategori" => $_POST['id_kategori'],
                  "id_kontributor" => $_POST['id_kontributor'],
                  "tanggal"  => $_POST['tanggal'],
                  "link"  => $_POST['link'],
                  "deskripsi"  => $_POST['deskripsi'],
                  "thumbnail" => $namaFile
                );
                Insert("tb_kajian",$data);
                
                $file_name = $_FILES['thumbnail']['tmp_name'];
                $folder=$dirUpload.$namaFile;
                copy($file_name, $folder);
                // echo("<meta http-equiv='refresh' content='1'>"); //Refresh by HTTP 'meta'
                
              }else if($_POST['submit']=="Edit"){
                if(isset_file('thumbnail')) {
                  // $format = ".".end((explode(".", $name = $_FILES["thumbnail"]["name"]))); # extra () to prevent notice
                  $namaFile = $_POST["tanggal"]."-".$_POST["judul"].".jpg";
                  $namaSementara = $_FILES['thumbnail']['tmp_name'];
                  $dirUpload = "img/thumbnail/";
                  // pindahkan file
                  $file_name = $_FILES['thumbnail']['tmp_name'];
                    $folder=$dirUpload.$namaFile;
                    copy($file_name, $folder);
                }else{
                    $namaFile=$_POST["thumbnail_lama"];
                }
                $data2=array(
                  "judul"  => $_POST['judul'],
                  "id_ustad" => $_POST['id_ustad'],
                  "id_kategori" => $_POST['id_kategori'],
                  "id_kontributor" => $_POST['id_kontributor'],
                  "tanggal"  => $_POST['tanggal'],
                  "link"  => $_POST['link'],
                  "deskripsi"  => $_POST['deskripsi'],
                  "thumbnail" => $namaFile
                );
                Update("tb_kajian",$data2,"id_kajian =".$_POST['id_kajian']);
              }else if($_POST['submit']=="Hapus"){
                $id_kajian = $_POST['id_kajian'];
                Delete("tb_kajian","WHERE id_kajian = '".$id_kajian."'");
                if (array_key_exists('delete_file', $_POST)) {
                  $filename = "img/thumbnail/".$_POST['delete_file'];
                  if (file_exists($filename)) {
                    unlink($filename);
                  } else {
                    echo 'Could not delete '.$filename.', file does not exist';
                  }
                }
                // echo '<meta http-equiv="refresh" content="0; url=index.php?halaman=kajian" />';//now refresh page
                
              }
            }            
          ?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kajian</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Kajian</li>
            </ol>
          </div>
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Kajian</h6>
                  <button class="btn btn-primary" type="button" class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#tambah">+ Tambah Kajian</a>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>thumbnail</th>
                        <th>tanggal</th>
                        <th>Judul</th>
                        <th>Pendakwah</th>
                        <th>Kontributor</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $no = 1;
                      $data = mysqli_query($connect,"SELECT * from v_kajian ORDER BY tanggal DESC");
                      while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                          <td><?php echo $no; $no++; ?></td>
                          <td><a data-fancybox="thumbnail" title="thumbnail Kajian" href="img/thumbnail/<?=$d['thumbnail'];?>"><img src="img/thumbnail/<?=$d['thumbnail'];?>" width="50" alt=""></a> </td>
                          <td><?php echo $d['tanggal']; ?></td>
                          <td><a href=""  data-toggle="modal" data-target="#modald<?php echo $d['id_kajian']; ?>"><?php echo $d['judul']; ?></a></td>
                          <td><?php echo $d['nama_ustad']; ?></td>
                          <td><?php echo $d['nama']; ?></td>
                          <td><?php echo $d['kategori']; ?></td>
                          <td><?php echo $d['deskripsi']; ?></td>
                          <td>
                            <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal<?php echo $d['id_kajian']; ?>"><i class="fa fa-edit"></i> </a>
                            <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalh<?php echo $d['id_kajian']; ?>"><i class="fa fa-trash"></i></a>
                          
                            <!--Hapus-->
                            <div class="modal fade" id="modalh<?php echo $d['id_kajian']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <center>Yakin ingin menghapus data <h5><div class="text-primary"><?=$d['judul']?></div></h5></center>
                                        <form method="POST">
                                          <input type="hidden" name="id_kajian" value="<?php echo $d['id_kajian']; ?>">
                                          <input type="hidden" value="<?php echo $d['thumbnail']; ?>" name="delete_file">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <!-- <a href="halaman/kajian.php?aksi=delete&id=<?php echo $d['id_kajian']; ?>" class="btn btn-primary" >Hapus</a> -->
                                    <input type="submit" class="btn btn-primary" name="submit" value="Hapus" />
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Hapus -->
                            <!-- Detail -->
                            <div class="modal fade" id="modald<?php echo $d['id_kajian']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Detail Data Kajian</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="card mb-4">
                                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Data Kajian</h6>
                                      </div>
                                      <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                          <center>
                                            <a data-fancybox="thumbnail" title="thumbnail" href="img/thumbnail/<?=$d['thumbnail'];?>"><img src="img/thumbnail/<?=$d['thumbnail'];?>" width="150" alt=""></a>
                                          </center>
                                          <table class="table table-striped" style="margin-top:50px">
                                            <tbody style="padding-left:20px">
                                              <tr>
                                                <td scope="row">Judul</td>
                                                <td><?=$d['judul'];?></td>
                                              </tr>
                                              <tr>
                                                <td scope="row">Pendakwah</td>
                                                <td><?=$d['nama_ustad'];?></td>
                                              </tr>
                                              <tr>
                                                <td scope="row">Kontributor</td>
                                                <td><?=$d['nama'];?></td>
                                              </tr>
                                              <tr>
                                                <td scope="row">Kategori</td>
                                                <td><?=$d['kategori'];?></td>
                                              </tr>
                                              <tr>
                                                <td scope="row">Deskripsi</td>
                                                <td><textarea class="form-control" id="editor1" onclick="auto_grow(this)" name="resume"><?=$d['deskripsi']?></textarea></td>
                                              </tr>
                                              <tr>
                                                <td scope="row">tanggal</td>
                                                <td><?=$d['tanggal'];?></td>
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
                            <div class="modal fade" id="modal<?php echo $d['id_kajian']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Edit Data Kajian</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                <div class="modal-body">
                                  <div class="card mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                      <h6 class="m-0 font-weight-bold text-primary">Data Kajian</h6>
                                    </div>
                                    <div class="card-body">
                                      <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Judul Kajian</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="judul" placeholder="Judul Kajian" value="<?=$d['judul']?>" required>
                                            <input type="text" class="form-control" name="id_kajian" value="<?=$d['id_kajian']?>" required hidden>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Nama Ustad</label>
                                          <div class="col-sm-9">
                                            <select class="select2-single form-control" name="id_ustad" id="select2Single">
                                            <option value="">--Pilih Ustad--</option>
                                            <?php
                                              //query menampilkan nama unit kerja ke dalam combobox
                                              $query2=mysqli_query($connect, "SELECT * FROM tb_ustad");
                                              while ($data2 = mysqli_fetch_array($query2)) {
                                                ?>
                                                <option value="<?=$data2['id_ustad'];?>"<?php if($d['id_ustad']==$data2['id_ustad']){echo "selected";} ?>><?php echo $data2['nama_ustad'];?></option>
                                                <?php
                                              }
                                            ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Nama Kontributor</label>
                                          <div class="col-sm-9">
                                            <select class="select2-single form-control" name="id_kontributor" id="select2Single">
                                            <option value="">--Pilih Kontributor--</option>
                                            <?php
                                              //query menampilkan nama unit kerja ke dalam combobox
                                              $query2=mysqli_query($connect, "SELECT * FROM v_kontributor");
                                              while ($data2 = mysqli_fetch_array($query2)) {
                                                ?>
                                                <option value="<?=$data2['id_kontributor'];?>"<?php if($d['id_kontributor']==$data2['id_kontributor']){echo "selected";} ?>><?php echo $data2['nama'];?></option>
                                                <?php
                                              }
                                            ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Kategori</label>
                                          <div class="col-sm-9">
                                            <select class="select2-single form-control" name="id_kategori" id="select2Single">
                                            <option value="">--Pilih Kategori--</option>
                                            <?php
                                              //query menampilkan nama unit kerja ke dalam combobox
                                              $query2=mysqli_query($connect, "SELECT * FROM tb_kategori");
                                              while ($data2 = mysqli_fetch_array($query2)) {
                                                ?>
                                                <option value="<?=$data2['id_kategori'];?>"<?php if($d['id_kategori']==$data2['id_kategori']){echo "selected";} ?>><?php echo $data2['kategori'];?></option>
                                                <?php
                                              }
                                            ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Link</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="link" value="<?=$d['link']?>">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Tanggal</label>
                                          <div class="col-sm-9">
                                            <input type="date" class="form-control" name="tanggal" value="<?=$d['tanggal']?>">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Deskripsi</label>
                                          <div class="col-sm-9">
                                            <textarea class="form-control" id="editor1" name="deskripsi" onclick="auto_grow(this)"><?=$d['deskripsi']?></textarea>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">thumbnail</label>
                                          <div class="col-sm-9">
                                            <input type="file" class="form-control" name="thumbnail">
                                            <input type="text" class="form-control" name="thumbnail_lama" value="<?=$d['thumbnail'];?>" hidden>
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
          <!-- Tambah Kajian -->
          <div class="modal fade bd-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Tambah Kajian</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <div class="modal-body">
                <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kajian</h6>
                  </div>
                  <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Judul Kajian</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="judul">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                          <select class="select2-single form-control" name="id_kategori" id="select2Single">
                            <option value="">--Pilih Kategori--</option>
                              <?php
                                //query menampilkan nama unit kerja ke dalam combobox
                                $query22=mysqli_query($connect, "SELECT * FROM tb_kategori");
                                while ($data22 = mysqli_fetch_array($query22)) {
                                  ?>
                                  <option value="<?=$data22['id_kategori'];?>"><?php echo $data22['kategori'];?></option>
                                  <?php
                                }
                              ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Ustad</label>
                        <div class="col-sm-9">
                          <select class="select2-single form-control" name="id_ustad" id="select2Single">
                            <option value="">--Pilih Ustad--</option>
                              <?php
                                //query menampilkan nama unit kerja ke dalam combobox
                                $query22=mysqli_query($connect, "SELECT * FROM tb_ustad");
                                while ($data22 = mysqli_fetch_array($query22)) {
                                  ?>
                                  <option value="<?=$data22['id_ustad'];?>"><?php echo $data22['nama_ustad'];?></option>
                                  <?php
                                }
                              ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kontributor</label>
                        <div class="col-sm-9">
                          <select class="select2-single form-control" name="id_kontributor" id="select2Single">
                            <option value="">--Pilih Kontributor--</option>
                              <?php
                                //query menampilkan nama unit kerja ke dalam combobox
                                $query22=mysqli_query($connect, "SELECT * FROM v_kontributor");
                                while ($data22 = mysqli_fetch_array($query22)) {
                                  ?>
                                  <option value="<?=$data22['id_kontributor'];?>"><?php echo $data22['nama'];?></option>
                                  <?php
                                }
                              ?>
                          </select>
                        </div>
                      </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Deskripsi</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" id="editor1" name="deskripsi"></textarea>
                      </div>
                    </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" name="tanggal">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Link</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="link">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Thumbnail</label>
                        <div class="col-sm-9">
                          <input type="file" class="form-control" name="thumbnail">
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
        