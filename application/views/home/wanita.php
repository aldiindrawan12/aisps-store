<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AISPS STORE</title>  

    <!-- link bootsrapt -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/home.css') ?>">

</head>
<body>

<!-- Modal detail produk-->
<div class="modal fade" id="detailproduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span id="d-nama"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <table class="table table-bordered w-100">
              <tr>
                <td rowspan=5 width="45%"><img src="" class="figure-img img-fluid rounded" alt="..." id="d-gambar"></td>
                <td>Rp.<span class="" id="d-harga"></span></td>
              </tr>
              <tr>
                <td><p class="" id="d-deskripsi" style="text-align:justify">deskripsi</p></td>
              </tr>
              <tr>
                <td>Ukuran <span class="" id="d-ukuran">stok</span></td>
              </tr>
              <tr>
                <td><span class="" id="d-stok"></span> Tersedia</td>
              </tr>
              <tr>
                <td>Diskon <span class="" id="d-stok">0</span>%</td>
              </tr>
            </table>
            <?php if($status != "admin" && $status != ""){?>
              <form action="<?php echo base_url('index.php/home/add_keranjang')?>" method="POST">
                <input type="text" id="v-harga" name="v-harga" hidden>
                <input type="text" id="v-id" name="v-id" hidden>
                <div class="input-group">
                    <input type="number" name="v-jumlah" id="v-jumlah" placeholder="0" style="width:25%" class="form-control text-sm-center">
                </div>   
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary form-control">+ Keranjang</button>
                </div>
              </form>
            <?php }?>

        </div>

        <?php if($status == "admin"){?>
          <div class="modal-footer">
            <a href="" id="link-edit" class="btn btn-primary link-edit" data-toggle="modal" data-target="#editproduk" onclick="dataeditproduk(this)">
              <span>Edit</span>
            </a>
            <a href="" id="link-hapus" class="btn btn-primary">
              <span>Hapus</span>
            </a>
          </div>
        <?php } ?>

    </div>
  </div>
</div>
<!-- akhir Modal detail produk-->

<!-- Modal edit produk-->
<div class="modal fade" id="editproduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('home/edit_produk/wanita')?>
        <div class="modal-body">
        <input type="text" name="vid" id="vid" hidden>
          <div class="form-group">
            <input type="text" name="vnama" id="vname" class="form-control" placeholder="Nama Produk" value="">
          </div>
          <div class="form-group">
            <textarea rows="3" type="text" name="vdeskripsi" id="vdeskripsi" class="form-control" placeholder="Deskripsi"></textarea>
          </div>
          <div class="form-group">
            <input type="text" name="vharga" id="vharga" class="form-control" placeholder="Harga Produk">
          </div>
          <div class="form-group">
            <input type="number" name="vstok" id="vstok" class="form-control" placeholder="Stok Produk" min=0>
          </div>
          <div class="form-group">
            <label for="kategori-produk">Kategori Produk</label>
            <select name="vkategori" id="vkategori" class="form-control">
              <option value="Pria">Pria</option>
              <option value="Wanita">Wanita</option>
              <option value="Anak-Anak">Anak-Anak</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tipe-produk">Tipe Produk</label>
            <select name="vtipe" id="vtipe" class="form-control">
              <option value="Atasan">Atasan</option>
              <option value="Bawahan">Bawahan</option>
              <option value="Topi">Topi</option>
              <option value="Kerudung">Kerudung</option>
              <option value="Tas">Tas</option>
              <option value="Sepatu">Sepatu</option>
            </select>
          </div>
          <div class="form-group">
            <label for="ukuran-produk">Ukuran Produk</label>
            <select name="vukuran" id="vukuran" class="form-control">
              <option value="Tidak Ada">Tidak Ada</option>
              <option value="S">S</option>
              <option value="M">M</option>
              <option value="L">L</option>
              <option value="XL">XL</option>
              <option value="XXL">XXL</option>
            </select>
          </div>        
          <div class="form-group">
            <input type="number" name="vdiskon" id="vdiskon" class="form-control" placeholder="Diskon Produk" min=0 max=100>
          </div>
          <div class="form-group">
            <label for="gambar-produk">Gambar Produk</label>
            <input type="file" name="vgambar" id="vgambar" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Edit</button>
        </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- akhir Modal edit produk-->

<!-- tampilan produk -->
<div class="container mt-3" id="konten">
  <div class="text-center">
    <h1 style="font-size:2.5vmax;">Product Wanita</h1>
  </div>
  <div class="row">
    <?php foreach($produk_wanita as $value){?>
      <div class="konten border border-dark p-3 rounded">
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
<!-- akhir tampilan produk -->

<!-- script ambil data produk -->
<script>
  function dataproduk(a) {
    var id_produk = a.id;
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('index.php/home/get_produk') ?>",
      dataType: "JSON",
      data: {
        id: id_produk
      },
      success: function(data) {
        $("#v-harga").val(data["harga"]);
        $("#v-id").val(data["id_produk"]);
        $("#d-harga").text(data["harga"]);
        $("#d-deskripsi").text(data["deskripsi"]);
        $("#d-stok").text(data["stok_produk"]);
        $("#d-ukuran").text(data["ukuran"]);
        $("#d-nama").text(data["nama_produk"]);
        $("#d-gambar").attr("src","<?php echo base_url('assets/img/')?>"+data["gambar"]);
        $("#v-jumlah").attr({
          "max" : data["stok_produk"],
          "min" : 0
        });
        $("#link-hapus").attr({
          "href" : "<?php echo base_url('index.php/home/hapus_produk/')?>"+data["id_produk"]+"/wanita"
        });
        $(".link-edit").attr({
          "id" : data["id_produk"]
        });
      }
    });
  }
</script>
<!-- akhir script ambil data produk -->

<!-- script ambil data produk -->
<script>
  function dataeditproduk(a) {
    var id_produk = a.id;
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('index.php/home/get_produk') ?>",
      dataType: "JSON",
      data: {
        id: id_produk
      },
      success: function(data) {
        $("#vid").val(id_produk);
        $("#vname").val(data["nama_produk"]);
        $("#vdeskripsi").val(data["deskripsi"]);
        $("#vharga").val(data["harga"]);
        $("#vstok").val(data["stok_produk"]);
        $("#vkategori").val(data["kategori_produk"]);
        $("#vtipe").val(data["tipe_produk"]);
        $("#vukuran").val(data["ukuran"]);
        $("#vdiskon").val(data["diskon"]);
      }
    });
  }
</script>
<!-- akhir script ambil data produk -->

<script src="<?php echo base_url('assets/bootstrap/js/jquery-3.4.1.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/ajax/search.js') ?>"></script>
</body>
</html>