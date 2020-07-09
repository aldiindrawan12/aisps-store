<div class="container mt-3">
  <div class="text-center">
    <h1>Product <?php echo $title?></h1>
  </div>
  <div class="row" id="konten">
    <?php foreach($produk_search as $value){?>
        <div class="col-6 col-sm-3">
            <a href="" id="<?= $value["id_produk"]?>" data-toggle="modal" data-target="#detailproduk" onclick="dataproduk(this)">
                <figure class="figure p-3 rounded border border-primary">
                  <img src="<?php echo base_url('assets/img/').$value["gambar"] ?>" class="figure-img img-fluid rounded" alt="...">
                  <figcaption class="figure-caption text-center">
                    <span><?= $value["nama_produk"]?></span>
                  </figcaption>
                  <figcaption class="figure-caption text-left">
                    Rp.<span><?= $value["harga"]?></span>
                  </figcaption>
                  <figcaption class="figure-caption text-left">
                    <span><?= $value["stok_produk"]?></span> Tersedia
                  </figcaption>
                </figure>
            </a>
        </div>
    <?php } ?>  
  </div>
</div>