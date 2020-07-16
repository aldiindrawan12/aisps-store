<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Laporan Penjualan</title>  

    <!-- link bootsrapt -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/home.css') ?>">

</head>
<body>

<!-- tampilan laporan -->
<div class="container mt-3">
    <h4 class="text-center">Laporan Penjualan</h4>
    <h4 class="text-center">AISPS STORE</h4>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th class="text-center" width="10%">#ID Produk</th>
                <th class="text-center" width="40%">Nama Produk</th>
                <th class="text-center" width="20%">Stok Tersedia</th>
                <th class="text-center" width="20%">Terjual</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($produk as $value){?>
                <tr>
                    <td>#<?= $value["id_produk"]?></td>
                    <td><?= $value["nama_produk"]?></td>
                    <td><?= $value["stok_produk"]?></td>
                    <?php foreach($terjual as $value2){
                        if($value2["id_produk"] == $value["id_produk"]){?>
                            <td><?= $value2["terjual"]?></td>
                    <?php }
                    }?>
                </tr>
            <?php }?>
        </tbody>
        
    </table>
</div>
<!-- akhir tampilan laporan -->

<!-- script  -->
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
</script>
<!-- akhir script  -->

<script src="<?php echo base_url('assets/bootstrap/js/jquery-3.4.1.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>