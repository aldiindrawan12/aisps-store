
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
    <div class="data-pesanan">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#Id Pesanan</th>
                    <th>Total Pembayaran</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pesanan as $value){?>
                    <tr>
                        <td>#<?= $value["id_pesanan"]?></td>
                        <td>Rp.<?= $value["total"] ?></td>
                        <td>
                            <?= $value["status"] ?></br>
                            <strong>No Resi : <?= $value["no_resi"] ?></strong>
                        </td>
                        <td class="text-center">
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#detailpesanan" id="<?= $value["id_pesanan"]?>" onclick="getpesanan(this)"><span>Lihat</span></a>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<!-- akhir tampilan pesanan-->


<!-- Modal detail pesanan-->
<div class="modal fade" id="detailpesanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
            <table class=" table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody id="isi">
                </tbody>
            </table>
            <table class="table table-bordered">
            <tr>
                <td>Pesan Pembeli</td>
                <td width="75%"><span id="pesan"></span></td>
            </tr>
            </table>
            <tr>
                <td>
                    <form method="POST" id="pengiriman">
                    </form>
                </td>
            </tr>
        </div>

    </div>
  </div>
</div>
<!-- akhir Modal detail pesanan-->

<script>
    function getpesanan(a){
        var id_pesanan = a.id;
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('index.php/pesanan/get_pesanan') ?>",
            dataType: "JSON",
            data: {
                id: id_pesanan
            },
            success: function(data) {
                    $("#isi").empty();
                    $("#pengiriman").empty()
                    data_pesanan = jQuery.parseJSON(data["pesanan"]); //decode di javascript
                    var total_seluruh = 0;
                    for(i=0;i<data_pesanan.length;i++){
                        $("#isi").append("<tr><td>"+ data_pesanan[i]["nama_produk"] +"</td><td>"+ data_pesanan[i]["jumlah"] +"</td><td>Rp."+ data_pesanan[i]["total"] +"</td></tr>")
                        total_seluruh = total_seluruh + parseInt(data_pesanan[i]["total"]);
                    }
                    $("#pesan").text(data["pesan_pelanggan"])
                    $("#isi").append("<tr><td colspan=2>Total Pembayaran</td><td>Rp."+ total_seluruh +"</td></tr>");
                    if(data["status"] == "LUNAS"){
                        $("#pengiriman").append("<div class='form-group' id='resi'><input type='text' name='no_resi' id='no_resi' placeholder='Masukan No Resi' class='form-control' required></div>")
                        $("#pengiriman").append("<input type='submit' value='Konfirmasi Pengiriman' class='btn btn-primary'>");
                    }else{
                        $("#pengiriman").empty()
                    }
                    $("#pengiriman").attr({
                        "action":"<?php echo base_url('index.php/pesanan/pesanan_dikirim/') ?>"+id_pesanan
                    });
            }
        });
    }
</script>

<script src="<?php echo base_url('assets/bootstrap/js/jquery-3.4.1.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>