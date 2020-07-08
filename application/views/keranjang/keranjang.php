<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Keranjang</title>  

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
            <input type="text" id="v-harga" name="v-harga" hidden>
            <input type="text" id="v-id" name="v-id" hidden>
            <div class="input-group">
                <label for="v-jumlah" class="form-control">Jumlah Produk</label>
                <input type="text" name="v-jumlah" id="v-jumlah" placeholder="Jumlah Barang">
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

<!-- tampilan keranjang -->
<div class="container mt-3">
  <div class="text-center">
    <h1>Keranjang Anda</h1>
  </div>
  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th class="text-center" width="15%">Gambar</th>
            <th class="text-center" width="25%">Nama</th>
            <th class="text-center" width="5%">Ukuran</th>
            <th class="text-center" width="10%">Harga</th>
            <th class="text-center" width="20%">Jumlah</th>
            <th class="text-center" width="10%">Total</th>
            <th class="text-center" width="15%">aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $total_seluruh = 0;
        foreach($keranjang as $value){?>
            <tr>
                <td width="15%" class="text-center">
                    <img src="<?php echo base_url('assets/img/').$value["gambar"]?>" class="figure-img img-fluid rounded w-50" alt="..." id="k-gambar">
                </td>
                <td width="25%"><?= $value["nama_produk"]?></td>
                <td width="5%" class="text-center"><?= $value["ukuran"]?></td>
                <td width="10%">Rp.<?= $value["harga"]?></td>
                <td width="20%" class="text-center">
                    <?php if($value["jumlah_barang"] > 0){?>
                        <a href="#" class="btn btn-light border-dark w-25" id="<?= $value["id_keranjang"]?> " onclick="min(this)">
                            <img width="30%" src="<?php echo base_url('assets/img/min.png')?>" alt="min">
                        </a>
                    <?php }else{?>
                        <a href="#" class="btn btn-light border-dark w-25">
                            <img width="30%" src="<?php echo base_url('assets/img/min.png')?>" alt="min">
                        </a>
                    <?php }?>
                    <span class="mr-3 ml-3" id="t-jumlah"><?= $value["jumlah_barang"]?></span>
                    <a href="#" class="btn btn-light border-dark w-25" id="<?= $value["id_keranjang"]?> " onclick="plus(this)">
                        <img width="30%" src="<?php echo base_url('assets/img/plus.png')?>" alt="plus">
                    </a>
                </td>
                <td width="10%">Rp.<span id="t-total"><?= $value["total_harga"]?></span></td>
                <td width="15%" class="text-center">
                    <a href="<?php echo base_url('index.php/keranjang/hapus_keranjang/').$value["id_keranjang"]?>" class="btn btn-dark">
                        <span>Hapus</span>
                    </a>
                </td>
            </tr>
        <?php 
            $total_seluruh += $value["total_harga"];
        }?>
        <tr>
            <td colspan="5" class="text-lg-right">Total Biaya</td>
            <td class="text-center">Rp.<span><?= $total_seluruh?></span></td>
            <td class="text-center">
                <a href="" class="btn btn-dark">
                    <span>Checkout</span>
                </a>
            </td>
        </tr>
    </tbody>
  </table>
</div>
<!-- akhir tampilan keranjang -->

<!-- script tambah dan kurang jumlah barang -->
<script>
    function min(a){
        var id_keranjang = a.id;
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('index.php/keranjang/update_jumlah/min') ?>",
            dataType: "text",
            data: {
                id: id_keranjang
            },
            success: function(data) {
                location.reload();
            }
        });
    }
    function plus(a){
        var id_keranjang = a.id;
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('index.php/keranjang/update_jumlah/plus') ?>",
            dataType: "text",
            data: {
                id: id_keranjang
            },
            success: function(data) {
                location.reload();
                // $("#t-total").text(data["total_harga"]);
                // $("#t-jumlah").text(data["jumlah_barang"]);
            }
        });
    }
</script>
<!-- akhir script tambah dan kurang jumlah barang -->

<script src="<?php echo base_url('assets/bootstrap/js/jquery-3.4.1.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>