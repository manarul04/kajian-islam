<?php // jika submit button diklik
            if($_SERVER['REQUEST_METHOD'] == "POST"){
              if($_POST['submit']=="Simpan"){
                $data=array(
                  "kategori"  => $_POST['kategori']
                );
                Insert("tb_kategori",$data);
                
              }else if($_POST['submit']=="Edit"){
                
                $data2=array(
                  "kategori"  => $_POST['kategori']
                );
                Update("tb_kategori",$data2,"id_kategori =".$_POST['id_kategori']);
              }else if($_POST['submit']=="Hapus"){
                $id_kategori = $_POST['id_kategori'];
                Delete("tb_kategori","WHERE id_kategori = '".$id_kategori."'");
                if (array_key_exists('delete_file', $_POST)) {
                  $filename = "img/foto/".$_POST['delete_file'];
                  
                }
                // echo '<meta http-equiv="refresh" content="0; url=index.php?halaman=ustad" />';//now refresh page
                
              }
            }            
          ?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Kategori</li>
            </ol>
          </div>
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
                  <button class="btn btn-primary" type="button" class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#tambah">+ Tambah Kategori</a>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $no = 1;
                      $data = mysqli_query($connect,"SELECT * from tb_kategori ");
                      while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                          <td><?php echo $no; $no++; ?></td>
                          <td><?php echo $d['kategori']; ?></td>
                          <td>
                            <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal<?php echo $d['id_kategori']; ?>"><i class="fa fa-edit"></i> </a>
                            <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalh<?php echo $d['id_kategori']; ?>"><i class="fa fa-trash"></i></a>
                          
                            <!--Hapus-->
                            <div class="modal fade" id="modalh<?php echo $d['id_kategori']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                          <input type="hidden" name="id_kategori" value="<?php echo $d['id_kategori']; ?>">
                                          <input type="hidden" value="<?php echo $d['foto']; ?>" name="delete_file">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <!-- <a href="halaman/ustad.php?aksi=delete&id=<?php echo $d['id_kategori']; ?>" class="btn btn-primary" >Hapus</a> -->
                                    <input type="submit" class="btn btn-primary" name="submit" value="Hapus" />
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Hapus -->
                            <!-- Detail -->
                            <div class="modal fade" id="modald<?php echo $d['id_kategori']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Detail Data Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="card mb-4">
                                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
                                      </div>
                                      <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                          <table class="table table-striped" style="margin-top:50px">
                                            <tbody style="padding-left:20px">
                                              <tr>
                                                <td scope="row">Kategori</td>
                                                <td><?=$d['kategori'];?></td>
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
                            <div class="modal fade" id="modal<?php echo $d['id_kategori']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Edit Data Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                <div class="modal-body">
                                  <div class="card mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                      <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
                                    </div>
                                    <div class="card-body">
                                      <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Kategori</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" name="kategori" placeholder="Kategori" value="<?=$d['kategori']?>" required>
                                            <input type="text" class="form-control" name="id_kategori" value="<?=$d['id_kategori']?>" required hidden>
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
          <!-- Tambah Kategori -->
          <div class="modal fade bd-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Tambah Kategori</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <div class="modal-body">
                <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
                  </div>
                  <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="kategori">
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
        