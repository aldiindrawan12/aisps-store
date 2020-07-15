<?php 
 header('Content-Type: application/vnd.ms-excel');
 header('Content-Disposition: attachment;filename="Latihan.xls"');
 header('Cache-Control: max-age=0');
?>
<table border="1" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>#ID Pesanan</th>
            <th>Tanggal Pesanan</th>
            <th>Total Pembayaran (IDR)</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; 
        $total = 0;
        foreach($pesanan as $value) { ?>
        <tr>
            <td><?php echo $i ?></td>
            <td>#<?php echo $value["id_pesanan"] ?></td>
            <td><?php echo $value["tanggal_pesanan"] ?></td>
            <td><?php echo $value["total"] ?></td>
        </tr>
        <?php $i++;
        $total += $value["total"]; } ?>
        <tr>
            <td colspan=3>Total Pemasukan</td>
            <td><?php echo $total?></td>
        </tr>
    </tbody>
</table>