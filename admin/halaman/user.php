<?php // jika submit button diklik
            if($_SERVER['REQUEST_METHOD'] == "POST"){
              if($_POST['submit']=="Simpan"){
                $namaFile = "USER"."-".$_POST["nama"].".jpg";
                $dirUpload = "img/foto/";
                $idpengguna = cek("tb_pengguna","id_pengguna");
                $data=array(
                  "id_pengguna"  => $idpengguna,
                  "nama"  => $_POST['nama'],
                  "alamat"  => $_POST['alamat'],
                  "email"  => $_POST['email'],
                  "foto" => $namaFile
                );
                Insert("tb_pengguna",$data);
                
                $datauser=array(
                  "username"  => $_POST['username'],
                  "password"  => $_POST['password'],
                  "level"  => $_POST['level'],
                  "id_pengguna"  => $idpengguna
                );
                Insert("tb_user",$datauser);
                
                $file_name = $_FILES['foto']['tmp_name'];
                $folder=$dirUpload.$namaFile;
                copy($file_name, $folder);
                // echo("<meta http-equiv='refresh' content='1'>"); //Refresh by HTTP 'meta'
              }else if($_POST['submit']=="Edit"){
                if(isset_file('foto')) {
                  // $format = ".".end((explode(".", $name = $_FILES["foto"]["name"]))); # extra () to prevent notice
                  $namaFile = "USER"."-".$_POST["nama"].".jpg";
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
                  "nama"  => $_POST['nama'],
                  "alamat"  => $_POST['alamat'],
                  "email"  => $_POST['email'],
                  "foto" => $namaFile
                );
                Update("tb_pengguna",$data2,"id_pengguna =".$_POST['id_pengguna']);
                $dataa2=array(
                  "username"  => $_POST['username'],
                  "password"  => $_POST['password'],
                  "level"  => $_POST['level']
                );
                Update("tb_user",$dataa2,"id_pengguna =".$_POST['id_pengguna']);
              }else if($_POST['submit']=="Hapus"){
                $id_pengguna = $_POST['id_pengguna'];
                Delete("tb_user","WHERE id_pengguna = '".$id_pengguna."'");
                if (array_key_exists('delete_file', $_POST)) {
                  $filename = "img/foto/".$_POST['delete_file'];
                  if (file_exists($filename)) {
                    unlink($filename);
                  } else {
                    echo 'Could not delete '.$filename.', file does not exist';
                  }
                }
                // echo '<meta http-equiv="refresh" content="0; url=index.php?halaman=user" />';//now refresh page
                
              }
            }            
          ?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">User</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">User</li>
            </ol>
          </div>
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                  <button class="btn btn-primary" type="button" class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#tambah">+ Tambah User</a>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $no = 1;
                      $data = mysqli_query($connect,"SELECT * from v_user ");
                      while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                          <td><?php echo $no; $no++; ?></td>
                          <td><a data-fancybox="foto" title="foto User" href="img/foto/<?=$d['foto'];?>"><img src="img/foto/<?=$d['foto'];?>" width="50" alt=""></a> </td>
                          <td><a href=""  data-toggle="modal" data-target="#modald<?php echo $d['id_pengguna']; ?>"><?php echo $d['nama']; ?></a></td>
                          <td><?php echo $d['level']; ?></td>
                          <td>
                            <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal<?php echo $d['id_pengguna']; ?>"><i class="fa fa-edit"></i> </a>
                            <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalh<?php echo $d['id_pengguna']; ?>"><i class="fa fa-trash"></i></a>
                          
                            <!--Hapus-->
                            <div class="modal fade" id="modalh<?php echo $d['id_pengguna']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <center>Yakin ingin menghapus data <h5><div class="text-primary"><?=$d['nama']?></div></h5></center>
                                        <form method="POST">
                                          <input type="hidden" name="id_pengguna" value="<?php echo $d['id_pengguna']; ?>">
                                          <input type="hidden" value="<?php echo $d['foto']; ?>" name="delete_file">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <!-- <a href="halaman/user.php?aksi=delete&id=<?php echo $d['id_pengguna']; ?>" class="btn btn-primary" >Hapus</a> -->
                                    <input type="submit" class="btn btn-primary" name="submit" value="Hapus" />
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Hapus -->
                            <!-- Detail -->
                            <div class="modal fade" id="modald<?php echo $d['id_pengguna']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Detail Data User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="card mb-4">
                                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                                      </div>
                                      <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                          <center>
                                            <a data-fancybox="foto" title="foto" href="img/foto/<?=$d['foto'];?>"><img src="img/foto/<?=$d['foto'];?>" width="150" alt=""></a>
                                          </center>
                                          <table class="table table-striped" style="margin-top:50px">
                                            <tbody style="padding-left:20px">
                                              <tr>
                                                <td scope="row">Nama</td>
                                                <td><?=$d['nama'];?></td>
                                              </tr>
                                              <tr>
                                                <td scope="row">Alamat</td>
                                                <td><?=$d['alamat'];?></td>
                                              </tr>
                                              <tr>
                                                <td scope="row">Email</td>
                                                <td><?=$d['email'];?></td>
                                              </tr>
                                              <tr>
                                                <td scope="row">Username</td>
                                                <td><?=$d['username'];?></td>
                                              </tr>
                                              <tr>
                                                <td scope="row">Password</td>
                                                <td><?=$d['password'];?></td>
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
                            <div class="modal fade" id="modal<?php echo $d['id_pengguna']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Edit Data User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                <div class="modal-body">
                                  <div class="card mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                      <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                                    </div>
                                    <div class="card-body">
                                      <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Nama</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nama" placeholder="Nama User" value="<?=$d['nama']?>" required>
                                            <input type="text" class="form-control" name="id_pengguna" value="<?=$d['id_pengguna']?>" required hidden>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Alamat</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?=$d['alamat']?>" required>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Email</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="email" placeholder="Email" value="<?=$d['email']?>" required>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Level</label>
                                          <div class="col-sm-9">
                                            <select class="select2-single form-control" name="level" id="select2Single">
                                              <option value="">--Pilih Level User--</option>
                                              <option value="admin" <?php if($d['level']=='admin'){echo "selected";} ?>>Admin</option>
                                              <option value="kontributor" <?php if($d['level']=='kontributor'){echo "selected";} ?>>Kontributor</option>
                                              <option value="pengguna" <?php if($d['level']=='pengguna'){echo "selected";} ?>>Pengguna</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Username</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="username" placeholder="Username" value="<?=$d['username']?>" required>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Password</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="password" placeholder="Password" value="<?=$d['password']?>" required>
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
          <!-- Tambah User -->
          <div class="modal fade bd-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Tambah User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <div class="modal-body">
                <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                  </div>
                  <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama User</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="nama">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="alamat">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Level</label>
                        <div class="col-sm-9">
                          <select class="select2-single form-control" name="level" id="select2Single">
                            <option value="">--Pilih Level User--</option>
                            <option value="admin">Admin</option>
                            <option value="kontributor">Kontributor</option>
                            <option value="pengguna">Pengguna</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="username">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="password">
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
        