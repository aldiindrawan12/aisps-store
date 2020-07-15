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
                <?php foreach($pesanan_status as $value){?>
                    <tr>
                        <td>#<?= $value["id_pesanan"]?></td>
                        <td>Rp.<?= $value["total"] ?></td>
                        <td>
                            <?= $value["status"] ?>
                            <?php if($value["no_resi"] == "" && $value["status"]=="Menunggu Pembayaran" && $status != "admin"){?>
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