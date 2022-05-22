<div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">
                Video Terbaru
            </h2>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <form action="" class="tm-text-primary">
                    Page <input type="text" value="1" size="1" class="tm-input-paging tm-text-primary"> of 200
                </form>
            </div>
        </div>
        <div class="row tm-mb-90 tm-gallery">
    <?php 
        $no = 1;
        $data = mysqli_query($connect,"SELECT * from v_kajian $sqlkajian ORDER BY tanggal DESC");
        while($d = mysqli_fetch_array($data)){
                        ?>
        
        	<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="admin/img/thumbnail/<?=$d['thumbnail'];?>" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2><?=$d['nama_ustad'];?></h2>
                        <a href="?halaman=detail&id=<?=$d['id_kajian'];?>">View more</a>
                    </figcaption>                    
                </figure>
                <span class="tm-text-primary"><i class="fa fa-user"></i>  <?=$d['nama_ustad'];?> | </span>
                <span class="tm-text-secondary"> </i><?=$d['kategori'];?></span>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-dark"><?=$d['judul'];?></span>
                    <span style="font-size:10pt; width:20%"><?=$d['tanggal'];?></span>
                </div>
            </div>
            <?php 
        }
        ?>     
        </div> <!-- row -->
        <div class="row tm-mb-90">
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
        </div>
    </div> <!-- container-fluid, tm-container-content -->