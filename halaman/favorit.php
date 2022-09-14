
<div class="container-fluid tm-container-content tm-mt-60">
    <div class="row mb-4">
        <h2 class="col-6 tm-text-primary">
            Video Favorit
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
        $data = mysqli_query($connect, "SELECT * from v_favorit where id_pengguna = '$id' ORDER BY tanggal DESC");
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
                <?php
                if (cekFavorite($d['id_kajian'], $id)) {
                    $icon        = 'bi-bookmark-check-fill';
                    $textFavorit = 'Menghapus';
                    $dariKe      = 'dari';
                    $warna       = 'danger';
                } else {
                    $icon        = 'bi-bookmark-plus';
                    $textFavorit = 'Menambahkan';
                    $dariKe      = 'ke';
                    $warna       = 'success';
                }
                ?>
                <?php if ($loginhdn == 'hidden') {   ?>
                    <span class="tm-text-secondary"> | <a href='#' data-toggle="modal" data-target="#modald<?= $d['id_kajian']; ?>"><i class="bi <?= $icon ?>"></i> Favorite </a> </span>
                <?php
                }
                ?>

                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-dark"><?= $d['judul']; ?></span>
                    <span style="font-size:10pt; width:20%"><?= $d['tanggal']; ?></span>
                </div>
            </div>

            <div class="modal fade" id="modald<?= $d['id_kajian']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelLogout">Favorit</h5>
                            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <form method="POST" action="">
                            <div class="modal-body">
                                Yakin ingin <?= $textFavorit ?> "<?= '<span class="tm-text-primary">' . $d['judul'] . '</span>'; ?>" <?= $dariKe ?> daftar favorit anda?
                            </div>
                            <input type="text" name="id_pengguna" value="<?= $id ?>" hidden>
                            <input type="text" name="id_kajian" value="<?= $d['id_kajian']; ?>" hidden>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-<?= $warna ?>" name="favorit" value="<?= $textFavorit ?>"><?= $textFavorit ?> <?= $dariKe ?> favorit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        
        ?>
    </div> <!-- row -->
    <!-- <div class="row tm-mb-90">
        <div class="col-12 d-flex justify-content-between align-items-center tm-paging-col">
            <a href="javascript:void(0);" class="btn btn-primary tm-btn-prev mb-2 disabled">Previous</a>
            <div class="tm-paging d-flex">
                <a href="javascript:void(0);" class="active tm-paging-link">1</a>
                <a href="javascript:void(0);" class="tm-paging-link">2</a>
                <a href="javascript:void(0);" class="tm-paging-link">3</a>
                <a href="javascript:void(0);" class="tm-paging-link">4</a>
            </div>
            <a href="javascript:void(0);" class="btn btn-primary tm-btn-next">Next Page</a>
        </div>
    </div> -->
</div> <!-- container-fluid, tm-container-content -->