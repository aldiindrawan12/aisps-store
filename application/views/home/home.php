<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AISPS STORE</title>  

    <!-- link bootsrapt -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">

</head>
<body>

<!-- Modal detail produk-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span id="d-nama"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('index.php/home/add_keranjang')?>" method="POST">
        <div class="modal-body">
            <img src="" class="figure-img img-fluid rounded w-50 float-left" alt="..." id="d-gambar">
            <span class="text-danger" id="d-harga">Rp.150000</span></br>
            <span class="text-danger" id="d-deskripsi">deskripsi</span></br>
            <span class="text-danger" id="d-stok">stok</span></br>
            <input type="text" id="v-harga" name="v-harga" hidden>
            <input type="text" id="v-id" name="v-id" hidden>
            <div class="input-group">
                <input type="number" name="v-jumlah" id="v-jumlah" placeholder="0" style="width:25%" class="text-sm-center">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">+ Keranjang</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- akhir Modal detail produk-->
<!-- tampilan produk -->
<div class="container mt-3">
  <div class="text-center">
    <h1>Product Bulan Ini</h1>
  </div>
  <div class="row">
    <?php foreach($produk_bulan as $value){?>
        <div class="col-6 col-sm-3">
            <a href="" id="<?= $value["id_produk"]?>" data-toggle="modal" data-target="#exampleModal" onclick="dataproduk(this)">
                <figure class="figure p-3 rounded border border-primary">
                  <img src="<?php echo base_url('assets/img/').$value["gambar"] ?>" class="figure-img img-fluid rounded" alt="...">
                  <figcaption class="figure-caption text-center">
                    <span><?= $value["nama_produk"]?></span>
                  </figcaption>
                </figure>
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
        $("#d-nama").text(data["nama_produk"]);
        $("#d-gambar").attr("src","<?php echo base_url('assets/img/')?>"+data["gambar"]);
        $("#v-jumlah").attr({
          "max" : data["stok_produk"],
          "min" : 0
        });
      }
    });
  }
</script>
<!-- akhir script ambil data produk -->
<script src="<?php echo base_url('assets/bootstrap/js/jquery-3.4.1.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>