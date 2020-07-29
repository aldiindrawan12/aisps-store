<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Keranjang</title>  

    <!-- link bootsrapt -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/home.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/sweetalert2/dist/sweetalert2.css') ?>">

</head>
<body>
<div class="hapus_keranjang" data-flashdata="<?= $this->session->flashdata("hapus_keranjang")?>"></div>

<!-- tampilan keranjang -->
<div class="container mt-3 rounded bg-light p-3">
  <div class="text-center">
    <h1>Keranjang Anda</h1>
  </div>
  <div class="tbl-keranjang-desktop">
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
                        <button  id="<?= $value["id_keranjang"]?>" class="btn btn-dark" onclick="hapus_keranjang(this)">
                            <span>Hapus</span>
                        </button>
                    </td>
                </tr>
            <?php 
                $total_seluruh += $value["total_harga"];
            }?>
            <tr>
                <td colspan="5" class="text-lg-right">Total Biaya</td>
                <td class="text-center">Rp.<span><?= $total_seluruh?></span></td>
                <?php if($total_seluruh > 0){?>
                    <td class="text-center">
                        <a href="<?php echo base_url('index.php/checkout/')?>" class="btn btn-dark">
                            <span>Checkout</span>
                        </a>
                    </td>
                <?php }?>
            </tr>
        </tbody>
    </table>
  </div>
  <div class="tbl-keranjang-mobile">
    <table class="table table-bordered">
        <tbody>
            <?php $total_seluruh = 0;
            foreach($keranjang as $value){?>
                <tr>
                    <td rowspan=4 class="text-center">
                        <img src="<?php echo base_url('assets/img/').$value["gambar"]?>" class="figure-img img-fluid rounded" alt="..." id="k-gambar">
                    </td>
                        <tr><td><?= $value["nama_produk"]?></td></tr>
                        <tr><td><?= $value["ukuran"]?></td></tr>
                        <tr><td>Rp.<?= $value["harga"]?></td></tr>
                </tr>
                <tr>
                    <td width="50%" class="text-center">
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
                    <td width="50%">Rp.<span id="t-total"><?= $value["total_harga"]?></span></td>
                </tr>
                <tr>
                    <td colspan=2 class="text-center">
                        <button  id="<?= $value["id_keranjang"]?>" class="btn btn-dark float-right" onclick="hapus_keranjang(this)">
                            <span>Hapus</span>
                        </button>
                    </td>
                </tr>
            <?php 
                $total_seluruh += $value["total_harga"];
            }?>
            <tr>
                <td class="text-lg-right">Total Biaya Keseluruhan</td>
                <td class="text-center">Rp.<span><?= $total_seluruh?></span></td>
            </tr>
            <tr>
                <?php if($total_seluruh > 0){?>
                    <td class="text-center" colspan=2>
                        <a href="<?php echo base_url('index.php/checkout/')?>" class="btn btn-dark float-right">
                            <span>Checkout</span>
                        </a>
                    </td>
                <?php }?>
            </tr>
        </tbody>
    </table>
  </div>
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
<script src="<?php echo base_url('assets/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>

<!-- sweetalert2 -->
<script>
  $(document).ready(function() {
    var hapus_keranjang = $(".hapus_keranjang").data("flashdata");
    // alert hapus keranjang
    if(hapus_keranjang){
      Swal.fire({
        title : "Keranjang",
        text:"Berhasil Dihapus",
        icon:"success",
        timer:1500
      });
    }
  });
  function hapus_keranjang(a){
    var href = "<?php echo base_url('index.php/keranjang/hapus_keranjang/')?>"+a.id;
    // alert (href);
    Swal.fire({
        title : "Anda Yakin",
        text:"Keranjang yang dihapus tidak bisa dikembalikan",
        icon:"warning",
        showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Ya",
        cancelButtonText: "Tidak"
      }).then((result) => {
        if (result.value) {
          document.location.href = href;
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire({
            title:'Dibatalkan',
            text:'Data Keranjang Anda Aman',
            icon:'error',
            timer:1000
          })
        }
      })
  }
</script>
<!-- akhir sweetalert2 -->
</body>
</html>