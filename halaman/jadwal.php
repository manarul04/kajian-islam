<div class="container-fluid tm-container-content tm-mt-60">
    <div class="row mb-4">
        <h2 class="col-6 tm-text-primary">
            Jadwal
        </h2>
        <div class="col-6 d-flex justify-content-end align-items-center">
            <!-- <form action="" class="tm-text-primary">
                    Page <input type="text" value="1" size="1" class="tm-input-paging tm-text-primary"> of 200
                </form> -->
        </div>
    </div>
    <div class="row tm-mb-90 tm-gallery">
        <?php
        $no = 1;
        $data = mysqli_query($connect, "SELECT * from tb_jadwal ORDER BY tanggal DESC");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="admin/img/jadwal/<?= $d['foto']; ?>" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2><?= $d['nama_kajian']; ?></h2>
                        <a href="?halaman=detail&id=<?= $d['id_jadwal']; ?>">View more</a>
                    </figcaption>
                </figure>
                <span class="tm-text-primary"><i class="fa fa-user"></i> <?= $d['nama_ustad']; ?> | </span>
                <span class="tm-text-primary"><i class="fa fa-location"></i> <?= $d['lokasi']; ?></span>
                <div class="d-flex justify-content-center tm-text-gray row">
                    <span class="col-6 tm-text-gray-dark"><?= $d['nama_kajian']; ?></span>
                    <span class="col-6" style="font-size:10pt; float:right"><?= $d['tanggal']; ?></span>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div> <!-- container-fluid, tm-container-content -->