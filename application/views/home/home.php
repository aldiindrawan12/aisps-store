<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AISPS STORE</title>  

    <!-- link bootsrapt -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">

</head>
<body>

<!-- Modal detail produk-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">nama produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="">
        <div class="modal-body">
            <img src="<?php echo base_url('assets/img/baju1.jpg') ?>" class="figure-img img-fluid rounded w-50 float-left" alt="...">
            <span class="text-danger">Rp.150000</span></br>
            <span class="text-danger">deskripsi</span></br>
            <span class="text-danger">Rating</span></br>
            <div class="input-group">
                <label for="ukuran" class="form-control">Ukuran</label>
                <select name="ukuran" id="ukuran" class="form-control col-2">
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">+ Keranjang</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- akhir Modal detail produk-->

<div class="container mt-3">
  <div class="text-center">
    <h1>Product Bulan Ini</h1>
  </div>
  <div class="row">
    <?php for($i=0;$i<10;$i++){?>
        <div class="col-6 col-sm-3">
            <a href="" data-toggle="modal" data-target="#exampleModal">
                <figure class="figure p-3 rounded border border-primary">
                    <?php if($i % 2 == 1){?>
                        <img src="<?php echo base_url('assets/img/baju1.jpg') ?>" class="figure-img img-fluid rounded" alt="...">
                        <figcaption class="figure-caption text-left">
                            <span>Baju pria</span>
                        </figcaption>
                    <?php } else { ?>
                        <img src="<?php echo base_url('assets/img/gree.jpeg') ?>" class="figure-img img-fluid rounded" alt="...">
                        <figcaption class="figure-caption text-center">
                        <span>Tas pria</span>
                    </figcaption>
                    <?php }?>
                </figure>
            </a>
        </div>
    <?php }?>
  </div>
</div>

<script src="<?php echo base_url('assets/bootstrap/js/jquery-3.4.1.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>