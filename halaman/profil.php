<?php 
    $data = mysqli_query($connect,"SELECT * from v_user where id_pengguna='$id'");
    $d = mysqli_fetch_array($data);
    ?>
<div class="container-fluid tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary">
                Profil - <?=$d['nama']?>
            </h2>
        </div>
        <div class="row tm-mb-74 tm-row-1640">            
            <div class="col-lg-5 col-md-6 col-12 mb-3">
              <?php
                if($d['foto']){
                  $foto = 'admin/img/foto/'.$d['foto'];
                }else{
                  $foto='';
                }
              ?>
                <img srcset="<?=$foto?>" src="img/foto.png" alt="Image" class="img-fluid" style="padding:50px">
            </div>
            <div class="col-lg-7 col-md-6 col-12">
                <div class="tm-about-img-text">
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
                    <input type="password" class="form-control" name="password" placeholder="Password" value="<?=$d['password']?>" required>
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
        
    </div> <!-- container-fluid, tm-container-content -->