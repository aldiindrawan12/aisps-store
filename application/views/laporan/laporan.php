<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Laporan Penjualan</title>  

    <!-- link bootsrapt -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/home.css') ?>"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css"/>

</head>
<body>

<!-- tampilan laporan -->
<div class="container mt-5">
    <a href="<?php echo base_url('index.php/pesanan/laporan_penjualan/') ?>" class="btn btn bg-light">Export Laporan Penjualan</a>
    <a href="<?php echo base_url('index.php/laporan/laporan_produk_terjual/') ?>" class="btn btn bg-light">Export Laporan Produk Terjual</a>
</div>
<div class="container">
    <h4 class="text-center">Laporan Penjualan Produk</h4>
    <h4 class="text-center">AISPS STORE</h4>
    <div class="table-responsive">
        <table class="table table-bordered" id="table-laporan">
            <thead class="thead-dark">
                <tr>
                    <th>nama pemesan</th>
                    <th>alamat</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<!-- akhir tampilan laporan -->

<!-- script untuk datatables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>    
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script>    
    var tabel = null;    
    $(document).ready(function() {        
        tabel = $('#table-laporan').DataTable({            
            "processing": true,            
            "serverSide": true,            
            "ordering": true, 
            "order": [[ 0, 'asc' ]],
            "ajax":            
            {                
                "url": "<?php echo base_url('index.php/laporan/view') ?>",
                "type": "POST"            
            },            
            "deferRender": true,            
            "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]],          
            "columns": [                
                { "data": "nama_pemesan" },
                { "data": "alamat" },          
                { "data": "status" }            
            ],        
        });    
    });    
</script>
<!-- akhir script untuk datatables -->
</body>
</html>