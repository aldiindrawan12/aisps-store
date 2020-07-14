var cari = document.getElementById('search');
var alamat = document.getElementById('link');
var konten = document.getElementById('konten');
var konten_pesanan = document.getElementById('konten-pesanan');
var alamat_status = document.getElementById('link-status');
var menunggu = document.getElementById('menunggu');
var lunas = document.getElementById('lunas');
var pengiriman = document.getElementById('pengiriman');
var selesai = document.getElementById('selesai');

cari.addEventListener('keyup', function(){
    //window.alert(alamat.value+cari.value);
	//buat objeck
	var ajaxCari = new XMLHttpRequest();
	ajaxCari.onreadystatechange = function(){
		if(ajaxCari.readyState == 4 && ajaxCari.status == 200){
			konten.innerHTML = ajaxCari.responseText;
		}
	}
	ajaxCari.open('GET', alamat.value+cari.value , true);
	ajaxCari.send();
});

menunggu.addEventListener('click', function(){
    // window.alert(alamat_status.value+"Menuggu Pembayaran");
	//buat objeck
	var ajaxmenunggu = new XMLHttpRequest();
	ajaxmenunggu.onreadystatechange = function(){
		if(ajaxmenunggu.readyState == 4 && ajaxmenunggu.status == 200){
			konten_pesanan.innerHTML = ajaxmenunggu.responseText;
		}
	}
	ajaxmenunggu.open('GET', alamat_status.value+"Menunggu Pembayaran" , true);
	ajaxmenunggu.send();
});

lunas.addEventListener('click', function(){
    // window.alert(alamat_status.value+"LUNAS");
	//buat objeck
	var ajaxmenunggu = new XMLHttpRequest();
	ajaxmenunggu.onreadystatechange = function(){
		if(ajaxmenunggu.readyState == 4 && ajaxmenunggu.status == 200){
			konten_pesanan.innerHTML = ajaxmenunggu.responseText;
		}
	}
	ajaxmenunggu.open('GET', alamat_status.value+"LUNAS" , true);
	ajaxmenunggu.send();
});

pengiriman.addEventListener('click', function(){
    // window.alert(alamat_status.value+"Dalam Pengiriman");
	//buat objeck
	var ajaxmenunggu = new XMLHttpRequest();
	ajaxmenunggu.onreadystatechange = function(){
		if(ajaxmenunggu.readyState == 4 && ajaxmenunggu.status == 200){
			konten_pesanan.innerHTML = ajaxmenunggu.responseText;
		}
	}
	ajaxmenunggu.open('GET', alamat_status.value+"Dalam Pengiriman" , true);
	ajaxmenunggu.send();
});

selesai.addEventListener('click', function(){
    // window.alert(alamat_status.value+"Selesai");
	//buat objeck
	var ajaxmenunggu = new XMLHttpRequest();
	ajaxmenunggu.onreadystatechange = function(){
		if(ajaxmenunggu.readyState == 4 && ajaxmenunggu.status == 200){
			konten_pesanan.innerHTML = ajaxmenunggu.responseText;
		}
	}
	ajaxmenunggu.open('GET', alamat_status.value+"Selesai" , true);
	ajaxmenunggu.send();
});