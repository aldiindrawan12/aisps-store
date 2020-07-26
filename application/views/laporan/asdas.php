<?php $id_produk = array();
            foreach($terjual as $value2){?>
                <tr>
                    <?php foreach($produk as $value){
                        if($value2["id_produk"] == $value["id_produk"]){?>
                            <td>#<?= $value["id_produk"]?></td>
                            <td><?= $value["nama_produk"]?></td>
                            <td><?= $value["stok_produk"]?></td>
                            <td><?= $value2["terjual"]?></td>
                    <?php 
                        array_push($id_produk,$value["id_produk"]);
                        }
                    }?>
                </tr>
            <?php }
            foreach($produk as $value){
                if(!in_array($value["id_produk"],$id_produk)){?>
                <tr>
                    <td>#<?= $value["id_produk"]?></td>
                    <td><?= $value["nama_produk"]?></td>
                    <td><?= $value["stok_produk"]?></td>
                    <td>0</td>
                    </tr>
            <?php 
                }
            }?>