<div class="container mt-3">
  <div class="text-center bg-light p-2 rounded w-50 m-auto">
    <h1 style="font-size:2.5vmax;">Product <?php echo $title?></h1>
  </div>
  <div class="row" id="konten">
    <?php foreach($produk_search as $value){?>
      <div class="konten border border-dark rounded <?php if($value['stok_produk'] == 0){ echo 'konten-habis'; }?>">
            <?php if($value["stok_produk"] == 0){?>
              <div class="habis">
                <h1>Habis</h1>
              </div>
            <?php }?>
            <a href="" id="<?= $value["id_produk"]?>" data-toggle="modal" data-target="#detailproduk" onclick="dataproduk(this)">
              <div class="container">
               <table class="m-auto table">
                 <tr>
                  <td class="text-center">
                    <img class="gambar" src="<?php echo base_url('assets/img/').$value["gambar"]?>" alt="gambar">
                  </td>
                 </tr>
                 <tr height="100px">
                  <td class="text-center">
                    <?php if(strlen($value["nama_produk"])>20){?>
                      <span class="text-nama"><?= substr($value["nama_produk"], 0,20);?>...</span>
                    <?php }else{?>
                      <span class="text-nama"><?=$value["nama_produk"]?></span>
                    <?php }?>
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