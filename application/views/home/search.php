<div class="container mt-3">
  <div class="text-center">
    <h1 style="font-size:2.5vmax;">Product <?php echo $title?></h1>
  </div>
  <div class="row" id="konten">
    <?php foreach($produk_search as $value){?>
      <div class="konten border border-dark p-3 rounded <?php if($value['stok_produk'] == 0){ echo 'konten-habis'; }?>">
            <?php if($value["stok_produk"] == 0){?>
              <div class="habis">
                <h1>Habis</h1>
              </div>
            <?php }?>
            <a href="" id="<?= $value["id_produk"]?>" data-toggle="modal" data-target="#detailproduk" onclick="dataproduk(this)">
              <div class="container">
               <table class="m-auto">
                 <tr>
                  <td class="text-center">
                    <img class="gambar" src="<?php echo base_url('assets/img/').$value["gambar"]?>" alt="gambar">
                  </td>
                 </tr>
                 <tr>
                  <td class="text-center">
                    <span class="text-nama"><?= $value["nama_produk"]?></span>
                  </td>
                 </tr>
                 <tr>
                  <td>
                    <span class="text">Rp.<?= $value["harga"]?></span>
                  </td>
                 </tr>
                 <tr>
                  <td>
                    <span class="text"><?= $value["stok_produk"]?> Tersedia</span>
                  </td>
                 </tr>
               </table>
              </div>
            </a>
        </div>
    <?php } ?>  
  </div>
</div>