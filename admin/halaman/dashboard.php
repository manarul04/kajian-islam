<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Kajian</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                          echo dashboardTotal("v_kajian","");
                          ?>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-video fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Ustad</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                          echo dashboardTotal("tb_ustad","");
                          ?>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Kontributor</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                          echo dashboardTotal("v_kontributor","");
                          ?>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Pengguna</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                          echo dashboardTotal("v_pengguna","");
                          ?>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-6">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Kontributor</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>kontributor</th>
                                <!--<th>Liputan</th>-->
                                  <th>Kajian</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $no = 1;
                                $data = mysqli_query($connect,"select * from v_kontributor ");
                                while($d = mysqli_fetch_array($data)){
                            ?>
                            <tr>
                              <td><a href=""data-toggle="modal" data-target="#modald<?php echo $d['id_kontributor']; ?>"><?php echo $d['nama']; ?></a>
                              <!-- Detail Kajian -->
                                <div class="modal fade" id="modald<?php echo $d['id_kontributor']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabelLogout">Detail Data Kajian</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                    <div class="modal-body">
                                        <!-- Horizontal Form -->
                                    <div class="card mb-4">
                                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Data Kajian</h6>
                                      </div>
                                      <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                        <!-- <center>
                                          <a data-fancybox="gallery" title="View Foto Satwa" href="foto_kajian/<?=$d['foto'];?>"><img src="foto_kajian/<?=$d['foto'];?>" width="150" alt=""></a> 
                                        </center> -->
                                        <table class="table table-striped" style="margin-top:10px">
                                        <tbody style="padding-left:20px">
                                        <tr>
                                            <th scope="row" width="40%">kontributor</th>
                                            <?php
                                              $nama=$d['nama'];
                                            ?>
                                            <td><?=$nama?></td>
                                          </tr>
                                          <tr>
                                            <td scope="row">Kajian</td>
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td scope="row">Video Tayang</td>
                                            <td></td>
                                          </tr>
                                          
                                        </tbody>
                                      </table>
                                        
                                        
                                      </div>
                                    </div>
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                              <?=capaian("v_kajian",$d['id_kontributor'],"id_kontributor")?>
                              </td>
                            </tr>
                            
                            <?php 
                              }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                  <a class="m-0 small text-primary card-link" href="kajian">Lihat Selengkapnya <i
                      class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-6">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Ustad</h6>
                  
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>kontributor</th>
                                <!--<th>Liputan</th>-->
                                <th>Kajian</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $no = 1;
                                $data = mysqli_query($connect,"select * from tb_ustad ");
                                while($d = mysqli_fetch_array($data)){
                            ?>
                            <tr>
                              <td><a href=""data-toggle="modal" data-target="#modald<?php echo $d['id_ustad']; ?>"><?php echo $d['nama_ustad']; ?></a>
                              <!-- Detail Kajian -->
                                <div class="modal fade" id="modald<?php echo $d['id_ustad']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabelLogout">Detail Data Kajian</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                    <div class="modal-body">
                                        <!-- Horizontal Form -->
                                    <div class="card mb-4">
                                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Data Ustad</h6>
                                      </div>
                                      <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                        <table class="table table-striped" style="margin-top:10px">
                                        <tbody style="padding-left:20px">
                                        <tr>
                                            <th scope="row" width="40%">ustad</th>
                                            <?php
                                              $nama=$d['nama'];
                                            ?>
                                            <td><?=$nama?></td>
                                          </tr>
                                          <tr>
                                            <td scope="row">Ustad</td>
                                            <td></td>
                                          </tr>
                                          
                                        </tbody>
                                      </table>
                                        
                                        
                                      </div>
                                    </div>
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                              <?=capaian("v_kajian",$d['id_ustad'],"id_ustad")?>
                              </td>
                            </tr>
                            
                            <?php 
                              }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                  <a class="m-0 small text-primary card-link" href="ustad">Lihat Selengkapnya <i
                      class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-6">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Kategori</h6>
                  
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Kategori</th>
                                <!--<th>Liputan</th>-->
                                <th>Kajian</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $no = 1;
                                $data = mysqli_query($connect,"select * from tb_kategori ");
                                while($d = mysqli_fetch_array($data)){
                            ?>
                            <tr>
                              <td><a href=""data-toggle="modal" data-target="#modald<?php echo $d['id_kategori']; ?>"><?php echo $d['kategori']; ?></a>
                              <!-- Detail Kajian -->
                                <div class="modal fade" id="modald<?php echo $d['id_kategori']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabelLogout">Detail Data Kajian</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                    <div class="modal-body">
                                        <!-- Horizontal Form -->
                                    <div class="card mb-4">
                                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Data kategori</h6>
                                      </div>
                                      <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                        <!-- <center>
                                          <a data-fancybox="gallery" title="View Foto Satwa" href="foto_kajian/<?=$d['foto'];?>"><img src="foto_kajian/<?=$d['foto'];?>" width="150" alt=""></a> 
                                        </center> -->
                                        <table class="table table-striped" style="margin-top:10px">
                                        <tbody style="padding-left:20px">
                                        <tr>
                                            <th scope="row" width="40%">kategori</th>
                                            <?php
                                              $nama=$d['kategori'];
                                            ?>
                                            <td><?=$nama?></td>
                                          </tr>
                                          <tr>
                                            <td scope="row">Kajian</td>
                                            <td></td>
                                          </tr>
                                          
                                        </tbody>
                                      </table>
                                        
                                        
                                      </div>
                                    </div>
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                              <?=capaian("v_kajian",$d['id_kategori'],"id_kategori")?>
                              </td>
                            </tr>
                            
                            <?php 
                              }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                  <a class="m-0 small text-primary card-link" href="kategori">Lihat Selengkapnya <i
                      class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div>
            
            
          </div>
          <!--Row-->

        <!---Container Fluid-->