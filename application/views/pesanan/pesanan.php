
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
    <?php if($status != ""){?>
        <div class="navbar navbar-expand-lg bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#status">
                <span class=""><img src="<?php echo base_url('assets/img/toggle.png') ?>"  style="width:30px;" alt="toggle"></span>
            </button>
            <div class="collapse navbar-collapse" id="status">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                    <a class="btn btn-light mr-3" href="#" style="font-size:1vmax;" tabindex="-1" id="menunggu">Menunggu Pembayaran</a>
                    </li>
                    <li class="nav-item">
                    <a class="btn btn-light mr-3" href="#" style="font-size:1vmax;" tabindex="-1" id="lunas">Lunas</a>
                    </li>
                    <li class="nav-item">
                    <a class="btn btn-light mr-3" href="#" style="font-size:1vmax;" tabindex="-1" id="pengiriman">Dalam Pengiriman</a>
                    </li>
                    <li class="nav-item">
                    <a class="btn btn-light mr-3" href="#" style="font-size:1vmax;" tabindex="-1" id="selesai">Selesai</a>
                    </li>
                </ul>
            </div>
        </div>
    <?php }?>
    <div class="data-pesanan" id="konten-pesanan">
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
                        <td>Rp.<?= number_format($value["total"],2,',','.') ?></td>
                        <td>
                            <?= $value["status"] ?>
                            <?php if($value["no_resi"] == "" && $value["status"]=="Menunggu Pembayaran"){?>
                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#uploadbukti" id="<?= $value["id_pesanan"]?>" onclick="uploadbukti(this)"><span>+ Bukti</span></a>
                            <?php }else if($value["no_resi"] != ""){?>
                                <strong>No Resi : <?= $value["no_resi"] ?></strong>
                            <?php }?>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
            <a id="cetak-laporan" class="btn btn bg-light">Cetak laporan</a>
            <h5><span id="tanggal-pesanan"></span></h5>
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
            <div id="rekening">
                <table>
                    <tr>
                        <h5>Silakan Lakukan Pembayaran</h5>
                    </tr>
                    <tr>
                        <h6><strong>Bank BRI</strong></h6>
                        <h6><strong>No Rekening : 213123123123123</strong></h6>
                        <h6><strong>Atas Nama   : Aldi Indrawan</strong></h6>
                    </tr>
                </table>
            </div>
            <table id="konfir-pembay">
                
            </table>
        </div>

    </div>
  </div>
</div>
<!-- akhir Modal detail pesanan-->
<!-- Modal detail pesanan-->
<div class="modal fade" id="uploadbukti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
        <?php echo form_open_multipart('pesanan/uploadbukti')?>
            <input type="text" name="id-pesanan" id="id-pesanan" hidden>
            <div class="form-group">
                <input type="file" name="bukti" id="bukti" class="form-control" required>
            </div>
            <input type="submit" name="" id="" value="Simpan" class="btn btn-primary">
        <?php echo form_close(); ?>               
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
                    $("#konfir-pembay").empty();
                    $("#isi").empty();
                    data_pesanan = jQuery.parseJSON(data["pesanan"]); //decode di javascript
                    var total_seluruh = 0;
                    for(i=0;i<data_pesanan.length;i++){
                        $("#isi").append("<tr><td>"+ data_pesanan[i]["nama_produk"] +"</td><td>"+ data_pesanan[i]["jumlah"] +"</td><td>Rp."+ data_pesanan[i]["total"] +"</td></tr>")
                        total_seluruh = total_seluruh + parseInt(data_pesanan[i]["total"]);
                    }
                    $("#isi").append("<tr><td colspan=2>Total Pembayaran</td><td>Rp."+ total_seluruh +"</td></tr>");
                    if(data["status"] == "Menunggu Pembayaran"){
                        $("#konfir-pembay").append("<td><a class='btn btn-warning' id='cancel'>Batalkan Pesanan</a></td>");
                        $("#rekening").removeAttr("style");
                    }else{
                        $("#rekening").attr({
                            "style":"display:none"
                        });
                        $("#konfir-pembay").empty();
                    }
                    $("#cancel").attr({
                        "href":"<?php echo base_url('index.php/pesanan/pesanan_cancel/') ?>"+id_pesanan
                    });
                    $("#cetak-laporan").attr({
                        "href":"<?php echo base_url('index.php/pesanan/cetak_laporan/') ?>"+id_pesanan
                    });
                    $("#tanggal-pesanan").text(data["tanggal_pesanan"]);      
            }
        });
    }
    function uploadbukti(a){
        var id_pesanan = a.id;
        $("#id-pesanan").val(id_pesanan);
    }
</script>

<script src="<?php echo base_url('assets/bootstrap/js/jquery-3.4.1.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<input type="text" value="<?php echo base_url('index.php/pesanan/status/')?>" id="link-status" hidden>
<script src="<?php echo base_url('assets/ajax/search.js') ?>"></script>
</body>
</html>