<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <a class="btn btn-light mr-auto brand text-center" href="<?php echo base_url()?>">
    <img src="<?php echo base_url('assets/img/as.png') ?>" alt="icon">
    <span class="display-5">AISPS STORE</span>
  </a>
  <div class="mr-auto ml-auto text-center text-light bg-secondary p-3">
    <span class="lead" style="font-size:2vmax;">SELAMAT DATANG DI AISPS STORE</span></br>
    <span class="lead" style="font-size:2vmax;"> <?php echo $pengguna["nama_pengguna"]; ?> </span>
  </div>
  <?php if($status != "admin" && $status != ""){?>
    <div>
      <a href="<?php echo base_url('index.php/keranjang')?>" class="btn btn-primary keranjang">
          <img src="<?php echo base_url('assets/img/keranjang.png') ?>" alt="keranjang">  
          <span class="text" >Keranjang</span>
      </a>
    </div>
  <?php }?>
</nav>
<div class="navbar navbar-expand-lg bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class=""><img src="<?php echo base_url('assets/img/toggle.png') ?>"  style="width:30px;" alt="toggle"></span>
  </button>
  <?php if($page != "keranjang" && $halaman != "checkout"){?>
    <ul class="navbar-nav">
      <li class="mr-3 nav-item">
        <input type="text" name="search" id="search" class="form-control" placeholder="masukkan kata kunci"  style="width:25vmax;font-size:1.5vmax;">
        <input type="text" value="<?php echo base_url('index.php/home/search/').$halaman."/"?>" id="link" hidden>
      </li>
    </ul>
  <?php }?>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto">
      <?php if($page != "keranjang" && $halaman != "checkout"){?>
        <li class="nav-item">
          <a class="btn btn-light mr-3" href="<?php echo base_url('index.php/kategori/pria')?>" style="font-size:1.5vmax;" tabindex="-1">Pria</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-light mr-3" href="<?php echo base_url('index.php/kategori/wanita')?>" style="font-size:1.5vmax;" tabindex="-1">Wanita</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-light mr-3" href="<?php echo base_url('index.php/kategori/anak')?>" style="font-size:1.5vmax;" tabindex="-1">Anak-Anak</a>
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
      <?php if($status != "admin"){?>
        <li class="nav-item">
          <a class="btn btn-light mr-3" href="<?php echo base_url('index.php/pesanan')?>" style="font-size:1.5vmax;" tabindex="-1">Pesanan Saya</a>
        </li>  
      <?php }else if($status == "admin" && $status != ""){?>
        <li class="nav-item">
          <a class="btn btn-light mr-3" href="<?php echo base_url('index.php/pesanan/pesanan_pengguna')?>" style="font-size:1.5vmax;" tabindex="-1">Pesanan Pelanggan</a>
        </li>
      <?php }
      if($username != "" ){?>
        <li class="nav-item">
            <a class="btn btn-light mr-3" style="font-size:1.5vmax;" href="<?php echo base_url('index.php/login/logout')?>" tabindex="-1">
                Logout
                <img src="<?php echo base_url('assets/img/logout.png') ?>" style="width:2.5vmax;" alt="keranjang">  
            </a>
        </li>
      <?php }else{?>
        <li class="nav-item">
            <a class="btn btn-light mr-3" href="<?php echo base_url('index.php/login/index')?>" tyle="font-size:1.5vmax;" stabindex="-1">
                <img src="<?php echo base_url('assets/img/login.png') ?>" style="width:2.5vmax;" alt="keranjang">  
                Login
            </a>
        </li>
      <?php }?>
    </ul>
  </div>
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
            <input type="text" name="nama-produk" id="nama-produk" class="form-control" placeholder="Nama Produk" required>
          </div>
          <div class="form-group">
            <textarea rows="3" type="text" name="deskripsi-produk" id="deskripsi-produk" class="form-control" placeholder="Deskripsi" required></textarea>
          </div>
          <div class="form-group">
            <input type="text" name="harga-produk" id="harga-produk" class="form-control" placeholder="Harga Produk" required>
          </div>
          <div class="form-group">
            <input type="number" name="stok-produk" id="stok-produk" class="form-control" placeholder="Stok Produk" min=1 required>
          </div>
          <div class="form-group">
            <label for="kategori-produk">Kategori Produk</label>
            <select name="kategori-produk" id="kategori-produk" class="form-control custom-select" required>
              <option value="Pria">Pria</option>
              <option value="Wanita">Wanita</option>
              <option value="Anak-Anak">Anak-Anak</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tipe-produk">Tipe Produk</label>
            <select name="tipe-produk" id="tipe-produk" class="form-control custom-select" required>
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
            <select name="ukuran-produk" id="ukuran-produk" class="form-control custom-select" required>
              <option value="Tidak Ada">Tidak Ada</option>
              <option value="S">S</option>
              <option value="M">M</option>
              <option value="L">L</option>
              <option value="XL">XL</option>
              <option value="XXL">XXL</option>
            </select>
          </div>        
          <div class="form-group">
            <input type="number" name="diskon-produk" id="diskon-produk" class="form-control" placeholder="Diskon Produk" min=0 max=100 >
          </div>
          <div class="form-group">
            <label for="gambar-produk">Gambar Produk</label>
            <input type="file" name="gambar-produk" id="gambar-produk" class="form-control" required>
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
