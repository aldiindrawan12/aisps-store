var cari = document.getElementById('search');
var alamat = document.getElementById('link');
var konten = document.getElementById('konten');

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
