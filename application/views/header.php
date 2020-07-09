<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <a class="navbar-brand btn btn-light" href="<?php echo base_url()?>">
    <img src="<?php echo base_url('assets/img/keranjang.png') ?>" alt="icon">
    <span class="display-5">AISPS STORE</span>
  </a>
  <div class="col-8 mr-3 text-center text-light">
    <span class="lead">SELAMAT DATANG DI AISPS STORE <?php echo $pengguna["nama_pengguna"]; ?></span>
  </div>
  <?php if($status != "admin" && $status != ""){?>
    <div>
      <a href="<?php echo base_url('index.php/keranjang')?>" class="btn btn-primary">
          <img src="<?php echo base_url('assets/img/keranjang.png') ?>" alt="keranjang">  
          <span class="">Keranjang</span>
      </a>
    </div>
  <?php }?>
</nav>
<div class="navbar navbar-expand-lg bg-light">
    <ul class="navbar-nav mr-auto">
      <?php if($page != "keranjang"){?>
        <li class="nav-item">
          <a class="btn btn-light mr-3" href="<?php echo base_url('index.php/kategori/pria')?>" tabindex="-1">Pria</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-light mr-3" href="<?php echo base_url('index.php/kategori/wanita')?>" tabindex="-1">Wanita</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-light mr-3" href="<?php echo base_url('index.php/kategori/anak')?>" tabindex="-1">Anak-Anak</a>
        </li>
        <li class="mr-3 nav-item">
          <input type="text" name="search" id="search" class="form-control" placeholder="masukkan kata kunci">
          <input type="text" value="<?php echo base_url('index.php/home/search/').$halaman."/"?>" id="link" hidden>
        </li>
        <?php if($status == "admin" && $status != ""){?>
          <li>
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#tambahproduk">
              <span>Tambah Produk</span>
            </a>
          </li>
        <?php }?>
      <?php } ?>
    </ul>
    <ul class="navbar-nav">
      <?php if($username != "" ){?>
        <li class="nav-item">
            <a class="btn btn-light mr-3" href="<?php echo base_url('index.php/login/logout')?>" tabindex="-1">
                Logout
                <img src="<?php echo base_url('assets/img/logout.png') ?>" alt="keranjang">  
            </a>
        </li>
      <?php }else{?>
        <li class="nav-item">
            <a class="btn btn-light mr-3" href="<?php echo base_url('index.php/login/index')?>" tabindex="-1">
                <img src="<?php echo base_url('assets/img/login.png') ?>" alt="keranjang">  
                Login
            </a>
        </li>
      <?php }?>
    </ul>
  </div>
  
<!-- Modal tambah produk-->
<div class="modal fade" id="tambahproduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('home/add_produk')?>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="nama-produk" id="nama-produk" class="form-control" placeholder="Nama Produk">
          </div>
          <div class="form-group">
            <textarea rows="3" type="text" name="deskripsi-produk" id="deskripsi-produk" class="form-control" placeholder="Deskripsi"></textarea>
          </div>
          <div class="form-group">
            <input type="text" name="harga-produk" id="harga-produk" class="form-control" placeholder="Harga Produk">
          </div>
          <div class="form-group">
            <input type="number" name="stok-produk" id="stok-produk" class="form-control" placeholder="Stok Produk" min=0>
          </div>
          <div class="form-group">
            <label for="kategori-produk">Kategori Produk</label>
            <select name="kategori-produk" id="kategori-produk" class="form-control">
              <option value="Pria">Pria</option>
              <option value="Wanita">Wanita</option>
              <option value="Anak-Anak">Anak-Anak</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tipe-produk">Tipe Produk</label>
            <select name="tipe-produk" id="tipe-produk" class="form-control">
              <option value="Atasan">Atasan</option>
              <option value="Bawahan">Bawahan</option>
              <option value="Topi">Topi</option>
              <option value="Kerudung">Kerudung</option>
              <option value="Tas">Tas</option>
              <option value="Sepatu">Sepatu</option>
            </select>
          </div>
          <div class="form-group">
            <label for="ukuran-produk">Ukuran Produk</label>
            <select name="ukuran-produk" id="ukuran-produk" class="form-control">
              <option value="Tidak Ada">Tidak Ada</option>
              <option value="S">S</option>
              <option value="M">M</option>
              <option value="L">L</option>
              <option value="XL">XL</option>
              <option value="XXL">XXL</option>
            </select>
          </div>        
          <div class="form-group">
            <input type="number" name="diskon-produk" id="diskon-produk" class="form-control" placeholder="Diskon Produk" min=0 max=100>
          </div>
          <div class="form-group">
            <label for="gambar-produk">Gambar Produk</label>
            <input type="file" name="gambar-produk" id="gambar-produk" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      <<?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- akhir Modal tambah produk-->
