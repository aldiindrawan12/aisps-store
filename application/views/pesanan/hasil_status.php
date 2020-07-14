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