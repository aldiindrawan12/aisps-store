<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Pesanan</title>  

    <!-- link bootsrapt -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/home.css') ?>">

</head>
<body>
<!-- tampilan pesanan-->
<div class="container mt-5">
    <div class="float-left pesanan">
        <table class="">
            <thead class="">
                <tr>
                    <th class="text-center">Isi Data Dibawah untuk Melakukan Pemesanan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <form action="<?php echo base_url('index.php/checkout/addpesanan')?>" method="POST">
                            <div class="form-group mt-4">
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat Pengiriman</label>
                                <textarea name="alamat" id="alamat" cols="6" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="no" id="no" class="form-control" placeholder="No Handphone">
                            </div>
                            <div class="form-group">
                                <label for="pesan-pelanggan">Pesan Untuk Penjual</label>
                                <textarea name="pesan-pelanggan" id="pesan-pelanggan" cols="6" rows="3" class="form-control"></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Buat Pesanan">
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="float-right pesanan-detail">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td colspan=4 class="text-center"><strong>Pesanan Anda</strong></td>
                </tr>
                <tr class="thead-dark">
                    <th width="35%">Nama Barang</th>
                    <th width="10%">Jumlah</th>
                    <th width="25%">Harga</th>
                    <th width="30%">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                $i=1;
                foreach ($keranjang as $value){?>
                    <tr>
                        <td width="35%"><?= $i.".".$value["nama_produk"] ?></td>
                        <td width="10%"><?= $value["jumlah_barang"]?></td>
                        <td width="25%">Rp.<?= $value["harga"]?></td>
                        <td width="30%">Rp.<?= $value["total_harga"]?></td>
                    </tr>
                <?php 
                $total += $value["total_harga"];
                $i+=1;
                }?>
                <tr>
                    <td colspan=3>Total Pembayaran</td>
                    <td>Rp.<?= $total?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div style="clear:both"></div>
<!-- akhir tampilan pesanan-->

<script src="<?php echo base_url('assets/bootstrap/js/jquery-3.4.1.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>