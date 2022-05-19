
<?php 
    if (isset($_GET['aksi'])=="delete"){
        // --- Fungsi Delete
        $id = $_GET['id'];
        //   echo $id;
                                
        // if($d['foto1']!="thumbnail.jpg"){
        //     unlink("foto_kajian/".$d['foto1']);
        // }
        // if($d['foto2']!="thumbnail.jpg"){
        //     unlink("foto_kajian/".$d['foto2']);
        // }
        // if($d['foto3']!="thumbnail.jpg"){
        //     unlink("foto_kajian/".$d['foto3']);
        // }
        Delete("tb_kajian","WHERE id_kajian = '".$_GET['id']."'");
        // echo '<meta http-equiv="refresh" content="0; url=kajian.php" />';//now refresh page
    }
?>
<?php
if($_SERVER['REQUEST_METHOD'] != "POST"){
    if($level=="Kontributor" || $level=="admin"){
?>
<?php


     if (isset($_GET['tahun'])){
         $tahun=$_GET['tahun'];
     }else{
         $tahun=date(Y);
     }
     $sqltahun ="AND YEAR(tanggal)='$tahun'";
     
     if (isset($_GET['bulan'])){
         $bulan=$_GET['bulan'];
     }else{
         $bulan=date(n);
     }
     $sqlbulan ="AND MONTH(tanggal)='$bulan'";
     
     $namaBulan = NamaBulan($bulan);
     
     if(isset($_GET['kategori'])){
         $kategori=$_GET['kategori'];
         $sql21 = mysqli_query($connect,"SELECT * from liputan where id_kategori_liputan=$kategori");
         $row21= mysqli_fetch_array($sql21);
         $txtkategori=$row21["kategori_liputan"];
         $sqlkategori="AND id_kategori_liputan='".$kategori."'";
     }else{
         $kategori="";
         $sqlkategori="";
         $txtkategori="";
     }
     
     if(isset($_GET['wilayah'])){
         $wilayah=$_GET['wilayah'];
         $sql21 = mysqli_query($connect,"SELECT * from liputan where id_wilayah=$wilayah");
         $row21= mysqli_fetch_array($sql21);
         $txtwilayah="Di ".$row21["wilayah"];
         $sqlwilayah="AND id_wilayah='".$wilayah."'";
     }else{
         $wilayah="";
         $sqlwilayah="";
         $txtwilayah="";
     }
     
     if(isset($_GET['reporter'])){
         $reporter=$_GET['reporter'];
         $sql21 = mysqli_query($connect,"SELECT * from reporter where id_reporter=$reporter");
         $row21= mysqli_fetch_array($sql21);
         $txtreporter=$row21["nama"];
         $sqlreporter="AND id_reporter='".$reporter."'";
     }else{
         $reporter="";
         $sqlreporter="";
         $txtreporter="";
     }
     
     if(isset($_GET['video'])){
         $video=$_GET['video'];
         
         $sqlvideo="AND video='".$video."'";
     }else{
         $video="";
         $sqlvideo="";
         $txtvideo="";
     }
     
     if(isset($_GET['tampil'])){
         if($_GET['tampil']=="All"){
             $sqlreporter="";
             $sqlkategori="";
             $sqlbulan="";
             $sqltahun="";
             $sqlwilayah="";
         }
     }
?>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><a href="kajian.php">Kajian</a> <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#search"><i class="fa fa-search"></i> </a></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="kajian.php">Kajian</a></li>
              <!-- <li class="breadcrumb-item active" aria-current="page">DataTables</li> -->
            </ol>
          </div>
           <div class="modal fade bd-example-modal-lg" id="search" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Filter Kajian</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <!-- Horizontal Form -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Kajian</h6>
                </div>
                <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Periode</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="tahun" placeholder="tahun">
                      </div>
                      <div class="col-sm-4">
                      <select class="select2-single form-control" name="bulan" id="select2Single">
                        <option value="">- Pilih Bulan -</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Kategori</label>
                      <div class="col-sm-4">
                        <select class="select2-single form-control" name="kategori_liputan" id="select2Single">
                            <option value="">--Pilih Kategori--</option>
                            <?php
                                //query menampilkan nama unit kerja ke dalam combobox
                                $query2    =mysqli_query($connect, "SELECT * FROM tb_kategori_liputan");
                                while ($data2 = mysqli_fetch_array($query2)) {
                            ?>
                            <option value="<?=$data2['id_kategori_liputan'];?>"><?php echo $data2['kategori_liputan'];?></option>
                            <?php
                                }
                            ?>
                        </select>
                      </div>
                      <div class="col-sm-4">
                      <select class="select2-single form-control" name="wilayah" id="select2Single">
                            <option value="">--Pilih Wilayah--</option>
                            <?php
                                //query menampilkan nama unit kerja ke dalam combobox
                                $query2    =mysqli_query($connect, "SELECT * FROM tb_wilayah");
                                while ($data2 = mysqli_fetch_array($query2)) {
                            ?>
                            <option value="<?=$data2['id_wilayah'];?>"><?php echo $data2['wilayah'];?></option>
                            <?php
                                }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Reporter</label>
                      <div class="col-sm-5">
                        <select class="select2-single form-control" name="reporter" id="select2Single">
                            <option value="">--Pilih Reporter--</option>
                            <?php
                                //query menampilkan nama unit kerja ke dalam combobox
                                $query2    =mysqli_query($connect, "SELECT * FROM reporter");
                                while ($data2 = mysqli_fetch_array($query2)) {
                            ?>
                            <option value="<?=$data2['id_reporter'];?>"><?php echo $data2['nama'];?></option>
                            <?php
                                }
                            ?>
                        </select>
                      </div>
                      <div class="col-sm-3">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="video" value="1" id="customControlAutosizing2">
                        <label class="custom-control-label" for="customControlAutosizing2">Video</label>
                      </div>
                    </div>
                </div>
              </div>
                </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-primary" name="submit" value="Cari" />
                  <a href="kajian.php?tampil=All" class="btn btn-warning">Semua</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
          </div>
          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Kajian <?=$txtreporter?> <?=$txtkategori?> <?=$txtwilayah?> Tahun <?=$tahun?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php 
                          $sql2 = mysqli_query($connect,"SELECT count(*)as jml  FROM kajian where YEAR(tanggal)='$tahun' $sqlkategori $sqlwilayah $sqlreporter");
                          $row2= mysqli_fetch_array($sql2);
                          $total = $row2["jml"];
                          echo $total;
                          ?>
                        </div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                          <!-- <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                          <span>Sejak Bulan Terakhir</span> -->
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-primary"></i>
                      </div>
                  </div>
                </div>
              </div>
            </div>
           
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Kajian <?=$txtreporter?> <?=$txtkategori?> <?=$txtwilayah?> Bulan <?=$namaBulan?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php 
                          $curDate = date("Y-m-d");
                          $sql2 = mysqli_query($connect,"SELECT COUNT(*) AS jml from kajian where Year(tanggal)='$tahun' AND Month(tanggal)='$bulan' $sqlkategori $sqlwilayah $sqlreporter;");
                          $row2= mysqli_fetch_array($sql2);
                          $total = $row2["jml"];
                          echo $total;
                          ?>
                        </div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        <?php
                          $sql21 = mysqli_query($connect,"SELECT COUNT(*) AS jml FROM kajian WHERE MONTH(tanggal) = MONTH(SUBDATE(CURDATE(), INTERVAL 1 MONTH)) $sqlkategori $sqlwilayah $sqlreporter;");
                          $row21= mysqli_fetch_array($sql21);
                          $totalkemarin = $row21["jml"];
                          if($totalkemarin>0){
                            $ttl = $total-$totalkemarin;
                            $persen =$ttl/$totalkemarin*100;
                            if($persen>=0){
                              $sts="Naik";
                              $txt="success";
                              $arrow="up";
                            }else{
                              $sts="Turun";
                              $txt="danger";
                              $arrow="down";
                            }
                          }else{
                            $sts="Naik";
                              $txt="success";
                              $arrow="up";
                              $persen="";
                          }
                          
                          ?>
                          <span class="text-<?=$txt?> mr-2"><i class="fa fa-arrow-<?=$arrow?>"></i><?=$sts?> <?=$persen."%"?></span>
                          <span>Dibandingkan Bulan Lalu</span>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-primary"></i>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Kajian <?=$txtreporter?> <?=$txtkategori?> <?=$txtwilayah?> Hari ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php 
                          $sql2 = mysqli_query($connect,"SELECT COUNT(kajian.id_kajian) AS jml, DATE_FORMAT(kajian.tanggal, '%Y-%m-%d') FROM kajian WHERE DATE(kajian.tanggal) = CURDATE() $sqlkategori $sqlwilayah $sqlreporter; ");
                          $row2= mysqli_fetch_array($sql2);
                          $total = $row2["jml"];
                          echo $total;
                          ?>
                        </div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        <?php
                          $sql21 = mysqli_query($connect,"SELECT COUNT(*) AS jml FROM kajian WHERE DATE(tanggal) = DATE(SUBDATE(CURDATE(),1)) $sqlkategori $sqlwilayah $sqlreporter");
                          $row21= mysqli_fetch_array($sql21);
                          $totalkemarin = $row21["jml"];
                          $ttl = $total-$totalkemarin;
                          $persen =$ttl/$totalkemarin*100;
                          if($persen>=0){
                            $sts="Naik";
                            $txt="success";
                            $arrow="up";
                          }else{
                            $sts="Turun";
                            $txt="danger";
                            $arrow="down";
                          }
                          ?>
                          <span class="text-<?=$txt?> mr-2"><i class="fa fa-arrow-<?=$arrow?>"></i><?=$sts?> <?=$persen."%"?></span>
                          <span>Dibandingkan Kemarin</span>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-primary"></i>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

          <!-- Row -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Kajian</h6>
                  <a href="kajian_tambah.php" class="btn btn-sm btn-primary" <?=$editdelete?>>+ Tambah </a>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                          <th>No</th>
                        <th>Tanggal</th>
                        <th>Judul Kajian</th>
                        <th>Foto</th>
                        <th>Kategori</th>
                        <th>Reporter</th>
                        <th>Redaksi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      
                      $no = 1;
                      $data = mysqli_query($connect,"select * from kajian where judul_kajian IS NOT NULL $sqlkategori $sqlwilayah $sqlreporter $sqltahun $sqlbulan $sqlvideo ORDER BY tanggal DESC");
                      while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td><?php echo $no; $no++;?></td>
                          <td><?php echo $d['tanggal']; ?></td>
                          <td class="text-table"><a href=""  data-toggle="modal" data-target="#modald<?php echo $d['id_kajian']; ?>"><?php echo $d['judul_kajian']; ?></a></td>
                         <td><?php  $foto1=$d['foto1'];
                                $foto2=$d['foto2'];
                                $foto3=$d['foto3'];
                                                if($d['foto1']!="thumbnail.jpg"){
                                                    echo "<a href='foto_kajian/$foto1' target='_blank' class='btn btn-sm btn-primary'><i class='fas fa-image'></i></a>";
                                                }
                                                if($d['foto2']!="thumbnail.jpg"){
                                                    echo "<a href='foto_kajian/$foto2' target='_blank' class='btn btn-sm btn-primary'><i class='fas fa-image'></i></a>";
                                                }
                                                if($d['foto3']!="thumbnail.jpg"){
                                                    echo "<a href='foto_kajian/$foto3' target='_blank' class='btn btn-sm btn-primary'><i class='fas fa-image'></i></a>";
                                                }?></td>
                          <td><?php echo $d['kategori_liputan']; ?></td>
                          <td><?php echo $d['reporter']; ?></td>
                          <td>
                              <?php 
                              if($d['redaksi']==""){
                                  echo '<a href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modala'.$d['id_kajian'].'">Ambil</a>';
                              }else{
                                  echo $d['redaksi']; 
                              }
                                
                              ?>
                          </td>
                          <td>
                              <!--<a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal<?php echo $d['id_kajian']; ?>" <?=$editdelete?>><i class="fa fa-edit"></i> </a>-->
                              <a href="kajian_edit.php?id_kajian=<?=$d['id_kajian']?>" class="btn btn-sm btn-warning" <?=$editdelete?>><i class="fa fa-edit"></i> </a>
                              <!--<a href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modala<?php echo $d['id_kajian']; ?>"><i class="fa fa-info"></i> </a>-->
                              <!-- <input type="submit" class="btn btn-danger" name="submit" value="Hapus" /> -->
                              <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalh<?php echo $d['id_kajian']; ?>" <?=$editdelete?>><i class="fa fa-trash"></i></a>

                            
                            <?php 
                            if (isset($_GET['update'])=="update"){
                            // --- Fungsi Delete
                                  $idu = $_GET['id'];
                                //   echo "ini update".$idu."REDAKSI".$id;
                                  
                                $sql = mysqli_query($connect,"UPDATE `tb_kajian` SET `id_redaksi` = '$id' WHERE `tb_kajian`.`id_kajian` = $idu;");
                                // if($sql){
                                //     echo '<script>swal("Berhasil!", "Klik OK", "success");</script>';
                                // }else{
                                //     echo '<script>swal("Gagal Disimpan!", "'.mysqli_error($connect).'", "error");</script>';
                                // }
                                  echo '<meta http-equiv="refresh" content="0; url=kajian.php" />';//now refresh page
                            }
                            ?>
                            <!--Hapus-->
                            <div class="modal fade" id="modalh<?php echo $d['id_kajian']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <!-- <div class="modal fade bd-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"> -->
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <!-- Horizontal Form -->
                                  <div class="card mb-4">
                                    
                                    <div class="card-body">
                                      <center>Yakin ingin menghapus data <h5><div class="text-primary"><?=$d['judul_kajian']?></div></h5></center>
                                    </div>
                                  </div>
                                    </div>
                                    <div class="modal-footer">
                                      
                                      <!-- <a href="login.html" class="btn btn-primary">Simpan</a> -->
                                      <a href="kajian.php?aksi=delete&id=<?php echo $d['id_kajian']; ?>" class="btn btn-primary" >Hapus</a>
                                      <!--<input type="submit" class="btn btn-primary" name="submit" value="Edit" />-->
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--Update-->
                            <div class="modal fade" id="modala<?php echo $d['id_kajian']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <!-- <div class="modal fade bd-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"> -->
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <!-- Horizontal Form -->
                                  <div class="card mb-4">
                                    
                                    <div class="card-body">
                                      <center>Yakin ingin menngedit kajian <h5><div class="text-primary"><?=$d['judul_kajian']?></div></h5></center>
                                    </div>
                                  </div>
                                    </div>
                                    <div class="modal-footer">
                                      
                                      <!-- <a href="login.html" class="btn btn-primary">Simpan</a> -->
                                      <a href="kajian.php?update=update&id=<?php echo $d['id_kajian']; ?>" class="btn btn-primary" >Ambil</a>
                                      <!--<input type="submit" class="btn btn-primary" name="submit" value="Edit" />-->
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <!-- Detail Kajian -->
                            <div class="modal fade bd-example-modal-xl" id="modald<?php echo $d['id_kajian']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <!-- <div class="modal fade bd-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"> -->
                                <div class="modal-dialog modal-xl">
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
                                      
                                      <table class="table table-striped" style="margin-top:10px">
                                      <tbody style="padding-left:20px">
                                        <tr>
                                          <td scope="row" width="20%">Reporter</th>
                                          <td><?=$d['reporter'];?></td>
                                        </tr>
                                        <tr>
                                          <td scope="row" width="20%">Redaksi</th>
                                          <td><?=$d['redaksi'];?></td>
                                        </tr>
                                        <tr>
                                          <td scope="row">Kategori Kajian</td>
                                          <td><?=$d['kategori_kajian'];?></td>
                                        </tr>
                                        <tr>
                                          <td scope="row">Judul Kajian</td>
                                          <td><?=$d['judul_kajian'];?></td>
                                        </tr>
                                        <tr>
                                          <td scope="row" colspan="2">Isi Kajian</td>
                                        </tr>
                                        <tr>
                                          <td colspan="2"><textarea class="form-control" id="<?=$d['id_kajian'];?>" name="isi_kajian"  onclick="countWords(this),auto_grow(this)" readonly><?=$d['isi_kajian'];?></textarea>
                                          <br>
                                            <p><em> Jumlah Kata: </em><span id="hitung<?=$d['id_kajian'];?>">0</span></p>
                                            <script>
                                            function countWords(element) {	
                                                var i = element.id;
                                                var id = "hitung"+i;
                                                    var text = element.value;
                                                    var numWords = 0;
                                                    for (var i = 0; i < text.length; i++) {
                                                        var currentCharacter = text[i];
                                            
                                                        if (currentCharacter == " " || currentCharacter == "\n") {
                                                            numWords += 1;
                                                        }
                                                    }
                                                    numWords += 1;
                                                    document.getElementById(id)
                                                        .innerHTML = numWords;
                                                }
                                            </script>
                                          </td>
                                          
                                        </tr>
                                        <tr>
                                          <td scope="row">Wilayah</td>
                                          <td><?=$d['wilayah'];?></td>
                                        </tr>
                                        <tr>
                                          <td scope="row">Lokasi</td>
                                          <td><?=$d['lokasi'];?></td>
                                        </tr>
                                        <tr>
                                          <td scope="row">Tagar</td>
                                          <td><?=$d['tagar'];?></td>
                                        </tr>
                                        <tr>
                                          <td scope="row">Foto</td>
                                          <td><?php if($d['foto']=="1"){echo "Ada";}?></td>
                                        </tr>
                                        <tr>
                                          <td scope="row">Video</td>
                                          <td><?php if($d['video']=="1"){echo "Ada";}?></td>
                                        </tr>
                                        <tr>
                                          <td scope="row">Tanggal Masuk</td>
                                          <td><?=$d['tanggal'];?></td>
                                        </tr>
                                        <tr>
                                          <td scope="row">Link</td>
                                          <td><textarea class="form-control" name="isi_kajian" readonly><?=$d['link'];?></textarea></td>
                                        </tr>
                                        <tr>
                                          <td scope="row">Lihat Foto Kajian</td>
                                          <td>
                                              <?php
                                               $foto1=$d['foto1'];
                                               $foto2=$d['foto2'];
                                               $foto3=$d['foto3'];
                                                if($d['foto1']!="thumbnail.jpg"){
                                                    echo "<a href='foto_kajian/$foto1' target='_blank'>$foto1</a></br>";
                                                }
                                                if($d['foto2']!="thumbnail.jpg"){
                                                    echo "<a href='foto_kajian/$foto2' target='_blank'>$foto2</a></br>";
                                                }
                                                if($d['foto3']!="thumbnail.jpg"){
                                                    echo "<a href='foto_kajian/$foto3' target='_blank'>$foto3</a></br>";
                                                }
                                               ?>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  
                                      <!--<a data-fancybox="gallery"  href="foto_kajian/<?=$d['foto1'];?>"><img src="foto_kajian/<?=$d['foto1'];?>" width="150" alt=""></a> -->
                                      <!--  <a data-fancybox="gallery"  href="foto_kajian/<?=$d['foto2'];?>"><img src="foto_kajian/<?=$d['foto2'];?>" width="150" alt=""></a> -->
                                      <!--  <a data-fancybox="gallery"  href="foto_kajian/<?=$d['foto3'];?>"><img src="foto_kajian/<?=$d['foto3'];?>" width="150" alt=""></a> -->
                                       
                                    </div>
                                  </div>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                             
                          
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

        <!-- Message From Customer-->

      
 <?php
    }else{
        echo ("<script LANGUAGE='JavaScript'>
    window.alert('Anda Bukan Redaksi');
    history.back();
    </script>");
    }
}else{
     $tanggal = date('Y-m-d');
    if($_POST['submit']=="Simpan"){
       
                // echo "Simpan";
                $id4c60da=  Cek("tb_kajian","id_kajian");
                // ambil data file
                $judul = preg_replace('/[0-9%$?,]/s','', $_POST['judul_kajian']);
                
                if(isset_file('foto1')) {
                  $namaFile1 = $tanggal."-".$judul."_1.jpg";
                  $namaSementara1 = $_FILES['foto1']['tmp_name'];
                }else{
                    $namaFile1="thumbnail.jpg";
                }
                
                if(isset_file('foto2')) {
                  $namaFile2 = $tanggal."-".$judul."_2.jpg";
                  $namaSementara2 = $_FILES['foto2']['tmp_name'];
                }else{
                    $namaFile2="thumbnail.jpg";
                }
                
                if(isset_file('foto3')) {
                  $namaFile3 = $tanggal."-".$judul."_3.jpg";
                  $namaSementara3 = $_FILES['foto3']['tmp_name'];
                }else{
                    $namaFile3="thumbnail.jpg";
                }
                
            
                
                if($_POST['kategori']=="1"){
                      $idnarsum=$_POST['id_narasumber'];
                  }elseif($_POST['kategori']=="2"){
                      $idnarsum=Cek("tb_narasumber","id_narasumber");
                      $data1=array(
                            "nama"  => $_POST['nama'],
                            "alamat"  => $_POST['alamat'],
                            "jabatan"  => $_POST['jabatan'],
                            "wa"  => $_POST['wa'],
                            "instansi"  => $_POST['instansi'],
                            "kategori_narasumber"  => "Redaksi",
                            "id_kategori_instansi"  => $_POST['id_kategori_instansi']
                        );
                        Insert("tb_narasumber",$data1);
                  }else{
                      $idnarsum=NULL;
                  }
                  
                $data1=array(
                  "id_kajian" => $idkajian,
                  "id_liputan" => $_POST['id_liputan'],
                  "judul_kajian"  => $_POST['judul_kajian'],
                  "isi_kajian"  => $_POST['isi_kajian'],
                  "link" => $_POST['link'],
                  "tgl_masuk"  => $_POST['tanggal'],
                  "id_redaksi"  => $_POST['id_redaksi'],
                  "foto1" => $namaFile1,
                  "foto2" => $namaFile2,
                  "foto3" => $namaFile3,
                  "id_narasumber" => $idnarsum,
                  "id_kategori_liputan"  => $_POST['kategori_liputan'],
                  "tagar"  => $_POST['tagar'],
                  "lokasi"  => $_POST['lokasi'],
                  "foto" => $_POST['foto'],
                  "video" => $_POST['video'],
                  "id_wilayah"  => $_POST['id_wilayah'],
                  "id_reporter"  => $_POST['id_reporter']
                );
                $insert=Insert("tb_kajian",$data1);
                 $dirUpload = "foto_kajian/";
                 $size1=$_FILES['foto1']['size'];
                 $size2=$_FILES['foto2']['size'];
                 $size3=$_FILES['foto3']['size'];
                 kompres($size1,$namaSementara1,$dirUpload.$namaFile1);
                 kompres($size2,$namaSementara2,$dirUpload.$namaFile2);
                 kompres($size3,$namaSementara3,$dirUpload.$namaFile3);
                if($insert){
                    echo '<script>swal("Berhasil Disimpan!", "Klik OK", "success");</script>';
                }else{
                    echo '<script>swal("Gagal Disimpan!", "'.mysqli_error($connect).'", "error");</script>';
                }
                
              }else if($_POST['submit']=="Edit"){
                  $judul = preg_replace('/[0-9%$?,]/s','', $_POST['judul_kajian']);
               if(isset_file('foto1')) {
                  $namaFile1 = $tanggal."-".$judul."_1.jpg";
                  $namaSementara1 = $_FILES['foto1']['tmp_name'];
                  $dirUpload = "foto_kajian/";
                  $size1=$_FILES['foto1']['size'];
                  kompres($size1,$namaSementara1,$dirUpload.$namaFile1);
                }else{
                    $namaFile1=$_POST["foto_lama1"];
                }
                
                if(isset_file('foto2')) {
                  $namaFile2 = $tanggal."-".$judul."_2.jpg";
                  $namaSementara2 = $_FILES['foto2']['tmp_name'];
                  $dirUpload = "foto_kajian/";
                  $size2=$_FILES['foto2']['size'];
                  kompres($size2,$namaSementara2,$dirUpload.$namaFile2);
                }else{
                    $namaFile2=$_POST["foto_lama2"];
                }
                
                if(isset_file('foto3')) {
                  $namaFile3 = $tanggal."-".$judul."_3.jpg";
                  $namaSementara3 = $_FILES['foto3']['tmp_name'];
                  $dirUpload = "foto_kajian/";
                  $size3=$_FILES['foto3']['size'];
                  kompres($size3,$namaSementara3,$dirUpload.$namaFile3);
                }else{
                    $namaFile3=$_POST["foto_lama3"];
                }
                if($_POST['id_narasumber']!="0"){
                      $idnarsum=$_POST['id_narasumber'];
                  }else{
                      $idnarsum=Cek("tb_narasumber","id_narasumber");
                      $data2=array(
                            "nama"  => $_POST['nama'],
                            "alamat"  => $_POST['alamat'],
                            "jabatan"  => $_POST['jabatan'],
                            "wa"  => $_POST['wa'],
                            "instansi"  => $_POST['instansi'],
                            "kategori_narasumber"  => "Redaksi",
                            "id_kategori_instansi"  => $_POST['id_kategori_instansi']
                        );
                        Insert("tb_narasumber",$data2);
                  }
                  
                $data1=array(
                  "id_kajian" => $_POST['id_kajian'],
                  "id_liputan" => $_POST['id_liputan'],
                  "judul_kajian"  => $_POST['judul_kajian'],
                  "link" => $_POST['link'],
                  "tgl_masuk"  => $_POST['tanggal'],
                  "id_redaksi"  => $_POST['id_redaksi'],
                  "foto1" => $namaFile1,
                  "foto2" => $namaFile2,
                  "foto3" => $namaFile3,
                  "id_narasumber" => $idnarsum,
                  "id_kategori_liputan"  => $_POST['kategori_liputan'],
                  "tagar"  => $_POST['tagar'],
                  "lokasi"  => $_POST['lokasi'],
                  "foto" => $_POST['foto'],
                  "video" => $_POST['video'],
                  "id_wilayah"  => $_POST['id_wilayah'],
                  "id_reporter"  => $_POST['id_reporter']
                );
                $edit = Update("tb_kajian",$data1,"id_kajian =".$_POST['id_kajian']);
                
                if($edit){
                    echo '<script>swal("Berhasil Disimpan!", "Klik OK", "success").then(history.back());</script>';
                }else{
                    echo '<script>swal("Gagal Disimpan!", "'.mysqli_error($connect).'", "error");</script>';
                }
                
              }else if($_POST['submit']=="Cari"){
                $link="kajian.php?";
                if($_POST['tahun']!=null){
                    $link = $link."tahun=".$_POST['tahun']."&";
                }
                if($_POST['bulan']!=null){
                    $link = $link."bulan=".$_POST['bulan']."&";
                }
                if($_POST['kategori_liputan']!=null){
                    $link = $link."kategori=".$_POST['kategori_liputan']."&";
                }
                if($_POST['wilayah']!=null){
                    $link = $link."wilayah=".$_POST['wilayah']."&";
                }
                if($_POST['reporter']!=null){
                    $link = $link."reporter=".$_POST['reporter']."&";
                }
                if($_POST['video']!=null){
                    $link = $link."video=".$_POST['video']."&";
                }
                echo '<meta http-equiv="refresh" content="0; url='.$link.'" />';//now refresh page
              }
}
      ?>
