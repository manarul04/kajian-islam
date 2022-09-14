    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = mysqli_query($connect, "SELECT * FROM v_kajian WHERE id_kajian='$id'");
        $row = mysqli_fetch_array($query);
        $judul = $row['judul'];
        $ustad = $row['nama_ustad'];
        $kategori = $row['kategori'];
        $deskripsi = $row['deskripsi'];
        $kontributor = $row['nama'];
        $link = $row['link'];
    }
    ?>
    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary"><?= $judul ?></h2>
        </div>
        <div class="row tm-mb-90">
            <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
                <iframe width="100%" height="600px" src="https://www.youtube.com/embed/<?= $link ?>?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <!-- <iframe src="<?= $link ?>?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allow="autoplay; encrypted-media"></iframe> -->
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="tm-bg-gray tm-video-details">

                    <div class="mb-4 d-flex flex-wrap">
                        <div class="mr-4 mb-2">
                            <span class="tm-text-gray-dark">Ustad: </span><span class="tm-text-primary"><?= $ustad ?></span>
                        </div>
                        <div class="mr-4 mb-2">
                            <span class="tm-text-gray-dark">Kontributor: </span><span class="tm-text-primary"><?= $kontributor ?></span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h3 class="tm-text-gray-dark mb-3">Deskripsi</h3>
                        <p><?= $deskripsi ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary">
                Video Terkait
            </h2>
        </div>
        <div class="row mb-3 tm-gallery">
            <?php
            $no = 1;
            $data = mysqli_query($connect, "SELECT * from v_kajian where kategori='$kategori' OR nama_ustad='$ustad' ORDER BY tanggal DESC");
            while ($d = mysqli_fetch_array($data)) {
            ?>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                    <figure class="effect-ming tm-video-item">
                        <img src="admin/img/thumbnail/<?= $d['thumbnail']; ?>" alt="Image" class="img-fluid">
                        <figcaption class="d-flex align-items-center justify-content-center">
                            <h2><?= $d['nama_ustad']; ?></h2>
                            <a href="?halaman=detail&id=<?= $d['id_kajian']; ?>">View more</a>
                        </figcaption>
                    </figure>
                    <span class="tm-text-primary"><i class="fa fa-user"></i> <?= $d['nama_ustad']; ?> | </span>
                    <span class="tm-text-secondary"> <?= $d['kategori']; ?></span>
                    <div class="d-flex justify-content-between tm-text-gray">
                        <span class="tm-text-gray-dark"><?= $d['judul']; ?></span>
                        <span style="font-size:10pt; width:20%"><?= $d['tanggal']; ?></span>
                    </div>
                </div>
            <?php
            }
            ?>
        </div> <!-- row -->
    </div> <!-- container-fluid, tm-container-content -->