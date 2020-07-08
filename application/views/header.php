<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <a class="navbar-brand btn btn-light" href="<?php echo base_url()?>">
    <img src="<?php echo base_url('assets/img/keranjang.png') ?>" alt="icon">
    AISPS STORE
  </a>

  <div class="col-8 mr-3 text-center text-light">
    <span class="lead">SELAMAT DATANG DI AISPS STORE <?php echo $pengguna["nama_pengguna"]; ?></span>
  </div>

  <div>
    <a href="<?php echo base_url('index.php/keranjang')?>" class="btn btn-primary">
        <img src="<?php echo base_url('assets/img/keranjang.png') ?>" alt="keranjang">  
        <span class="">Keranjang</span>
    </a>
  </div>
</nav>
<div class="navbar navbar-expand-lg bg-light">
    <ul class="navbar-nav mr-auto">
      <?php if($page != "keranjang"){?>
        <li class="nav-item">
          <a class="btn btn-light mr-3" href="#" tabindex="-1">Pria</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-light mr-3" href="#" tabindex="-1">Wanita</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-light mr-3" href="#" tabindex="-1">Anak-Anak</a>
        </li>
        <li class="mr-5 nav-item">
          <input type="text" name="search" id="search" class="form-control" placeholder="masukkan kata kunci">
        </li>
      <?php } ?>
    </ul>
    <ul class="navbar-nav">
      <?php if($username != ""){?>
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